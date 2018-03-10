<?php
/**
 * BillServiceTrait.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Services\Internal\Support;

use FireflyIII\Models\Bill;
use FireflyIII\Models\Note;

/**
 * Trait BillServiceTrait
 *
 * @package FireflyIII\Services\Internal\Support
 */
trait BillServiceTrait
{


    /**
     * @param Bill   $bill
     * @param string $note
     *
     * @return bool
     */
    public function updateNote(Bill $bill, string $note): bool
    {
        if (0 === strlen($note)) {
            $dbNote = $bill->notes()->first();
            if (null !== $dbNote) {
                $dbNote->delete(); // @codeCoverageIgnore
            }

            return true;
        }
        $dbNote = $bill->notes()->first();
        if (null === $dbNote) {
            $dbNote = new Note();
            $dbNote->noteable()->associate($bill);
        }
        $dbNote->text = trim($note);
        $dbNote->save();

        return true;
    }

}
