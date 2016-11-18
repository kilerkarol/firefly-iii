<?php
/**
 * TransactionJournal.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms of the
 * Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */

declare(strict_types = 1);

namespace FireflyIII\Models;

use Carbon\Carbon;
use Crypt;
use FireflyIII\Support\CacheProperties;
use FireflyIII\Support\Models\TransactionJournalSupport;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Log;
use Preferences;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Watson\Validating\ValidatingTrait;

/**
 * Class TransactionJournal
 *
 * @package FireflyIII\Models
 */
class TransactionJournal extends TransactionJournalSupport
{
    use SoftDeletes, ValidatingTrait;

    /** @var array */
    protected $dates = ['created_at', 'updated_at', 'date', 'deleted_at', 'interest_date', 'book_date', 'process_date'];
    /** @var array */
    protected $fillable
        = ['user_id', 'transaction_type_id', 'bill_id', 'interest_date', 'book_date', 'process_date',
           'transaction_currency_id', 'description', 'completed',
           'date', 'rent_date', 'encrypted', 'tag_count'];
    /** @var array */
    protected $hidden = ['encrypted'];
    /** @var array */
    protected $rules
        = [
            'user_id'                 => 'required|exists:users,id',
            'transaction_type_id'     => 'required|exists:transaction_types,id',
            'transaction_currency_id' => 'required|exists:transaction_currencies,id',
            'description'             => 'required|between:1,1024',
            'completed'               => 'required|boolean',
            'date'                    => 'required|date',
            'encrypted'               => 'required|boolean',
        ];

    /**
     * @param $value
     *
     * @return mixed
     * @throws NotFoundHttpException
     */
    public static function routeBinder($value)
    {
        if (auth()->check()) {
            $validTypes = [TransactionType::WITHDRAWAL, TransactionType::DEPOSIT, TransactionType::TRANSFER];
            $object     = TransactionJournal::where('transaction_journals.id', $value)
                                            ->leftJoin('transaction_types', 'transaction_types.id', '=', 'transaction_journals.transaction_type_id')
                                            ->whereIn('transaction_types.type', $validTypes)
                                            ->where('user_id', auth()->user()->id)->first(['transaction_journals.*']);
            if ($object) {
                return $object;
            }
        }

        throw new NotFoundHttpException;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function attachments()
    {
        return $this->morphMany('FireflyIII\Models\Attachment', 'attachable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo('FireflyIII\Models\Bill');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function budgets()
    {
        return $this->belongsToMany('FireflyIII\Models\Budget');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('FireflyIII\Models\Category');
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function deleteMeta(string $name):bool
    {
        $this->transactionJournalMeta()->where('name', $name)->delete();

        return true;
    }

    /**
     *
     * @param $value
     *
     * @return string
     */
    public function getDescriptionAttribute($value)
    {
        if ($this->encrypted) {
            return Crypt::decrypt($value);
        }

        return $value;
    }

    /**
     *
     * @param string $name
     *
     * @return string
     */
    public function getMeta(string $name)
    {
        $value = null;
        $cache = new CacheProperties;
        $cache->addProperty('journal-meta');
        $cache->addProperty($this->id);
        $cache->addProperty($name);

        if ($cache->has()) {
            return $cache->get();
        }

        Log::debug(sprintf('Looking for journal #%d meta field "%s".', $this->id, $name));
        $entry = $this->transactionJournalMeta()->where('name', $name)->first();
        if (!is_null($entry)) {
            $value = $entry->data;
            // cache:
            $cache->store($value);
        }

        // convert to Carbon if name is _date
        if (!is_null($value) && substr($name, -5) === '_date') {
            $value = new Carbon($value);
            // cache:
            $cache->store($value);
        }

        return $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMeta(string $name): bool
    {
        return !is_null($this->getMeta($name));
    }

    /**
     * @return bool
     */
    public function isDeposit()
    {
        if (!is_null($this->transaction_type_type)) {
            return $this->transaction_type_type == TransactionType::DEPOSIT;
        }

        return $this->transactionType->isDeposit();
    }

    /**
     *
     * @return bool
     */
    public function isOpeningBalance()
    {
        if (!is_null($this->transaction_type_type)) {
            return $this->transaction_type_type == TransactionType::OPENING_BALANCE;
        }

        return $this->transactionType->isOpeningBalance();
    }

    /**
     *
     * @return bool
     */
    public function isTransfer()
    {
        if (!is_null($this->transaction_type_type)) {
            return $this->transaction_type_type == TransactionType::TRANSFER;
        }

        return $this->transactionType->isTransfer();
    }

    /**
     *
     * @return bool
     */
    public function isWithdrawal()
    {
        if (!is_null($this->transaction_type_type)) {
            return $this->transaction_type_type == TransactionType::WITHDRAWAL;
        }

        return $this->transactionType->isWithdrawal();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function piggyBankEvents()
    {
        return $this->hasMany('FireflyIII\Models\PiggyBankEvent');
    }

    /**
     * Save the model to the database.
     *
     * @param  array $options
     *
     * @return bool
     */
    public function save(array $options = [])
    {
        $count           = $this->tags()->count();
        $this->tag_count = $count;

        return parent::save($options);
    }

    /**
     *
     * @param EloquentBuilder $query
     * @param Carbon          $date
     *
     * @return EloquentBuilder
     */
    public function scopeAfter(EloquentBuilder $query, Carbon $date)
    {
        return $query->where('transaction_journals.date', '>=', $date->format('Y-m-d 00:00:00'));
    }

    /**
     *
     * @param EloquentBuilder $query
     * @param Carbon          $date
     *
     * @return EloquentBuilder
     */
    public function scopeBefore(EloquentBuilder $query, Carbon $date)
    {
        return $query->where('transaction_journals.date', '<=', $date->format('Y-m-d 00:00:00'));
    }

    /**
     * @param EloquentBuilder $query
     */
    public function scopeExpanded(EloquentBuilder $query)
    {
        // left join transaction type:
        if (!self::isJoined($query, 'transaction_types')) {
            $query->leftJoin('transaction_types', 'transaction_types.id', '=', 'transaction_journals.transaction_type_id');
        }

        // left join transaction currency:
        $query->leftJoin('transaction_currencies', 'transaction_currencies.id', '=', 'transaction_journals.transaction_currency_id');

        // extend group by:
        $query->groupBy(
            [
                'transaction_journals.id',
                'transaction_journals.created_at',
                'transaction_journals.updated_at',
                'transaction_journals.deleted_at',
                'transaction_journals.user_id',
                'transaction_journals.transaction_type_id',
                'transaction_journals.bill_id',
                'transaction_journals.transaction_currency_id',
                'transaction_journals.description',
                'transaction_journals.date',
                'transaction_journals.interest_date',
                'transaction_journals.book_date',
                'transaction_journals.process_date',
                'transaction_journals.order',
                'transaction_journals.tag_count',
                'transaction_journals.encrypted',
                'transaction_journals.completed',
                'transaction_types.type',
                'transaction_currencies.code',
            ]
        );
        $query->with(['categories', 'budgets', 'attachments', 'bill', 'transactions']);
    }

    /**
     * @param EloquentBuilder $query
     */
    public function scopeSortCorrectly(EloquentBuilder $query)
    {
        $query->orderBy('transaction_journals.date', 'DESC');
        $query->orderBy('transaction_journals.order', 'ASC');
        $query->orderBy('transaction_journals.id', 'DESC');

    }

    /**
     *
     * @param EloquentBuilder $query
     * @param array           $types
     */
    public function scopeTransactionTypes(EloquentBuilder $query, array $types)
    {

        if (!self::isJoined($query, 'transaction_types')) {
            $query->leftJoin('transaction_types', 'transaction_types.id', '=', 'transaction_journals.transaction_type_id');
        }
        if (count($types) > 0) {
            $query->whereIn('transaction_types.type', $types);
        }
    }

    /**
     *
     * @param $value
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = Crypt::encrypt($value);
        $this->attributes['encrypted']   = true;
    }

    /**
     * @param string $name
     * @param        $value
     *
     * @return TransactionJournalMeta
     */
    public function setMeta(string $name, $value): TransactionJournalMeta
    {
        if (is_null($value)) {
            $this->deleteMeta($name);

            return new TransactionJournalMeta();
        }
        if (is_string($value) && strlen($value) === 0) {
            return new TransactionJournalMeta();
        }

        if ($value instanceof Carbon) {
            $value = $value->toW3cString();
        }

        Log::debug(sprintf('Going to set "%s" with value "%s"', $name, json_encode($value)));
        $entry = $this->transactionJournalMeta()->where('name', $name)->first();
        if (is_null($entry)) {
            $entry = new TransactionJournalMeta();
            $entry->transactionJournal()->associate($this);
            $entry->name = $name;
        }
        $entry->data = $value;
        $entry->save();
        Preferences::mark();

        return $entry;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('FireflyIII\Models\Tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionCurrency()
    {
        return $this->belongsTo('FireflyIII\Models\TransactionCurrency');
    }

    /**
     * @return HasMany
     */
    public function transactionJournalMeta(): HasMany
    {
        return $this->hasMany('FireflyIII\Models\TransactionJournalMeta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionType()
    {
        return $this->belongsTo('FireflyIII\Models\TransactionType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany('FireflyIII\Models\Transaction');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('FireflyIII\User');
    }

}
