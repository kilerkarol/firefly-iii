<?php

/**
 * validation.php
 * Copyright (c) 2019 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

return [
    'iban'                           => 'Αυτό δεν είναι έγκυρο IBAN.',
    'zero_or_more'                   => 'Αυτή η τιμή δεν μπορεί να είναι αρνητική.',
    'date_or_time'                   => 'Αυτή η τιμή πρέπει να είναι έγκυρη ημερομηνία ή τιμή ώρας (ISO 8601).',
    'source_equals_destination'      => 'Ο λογαριασμός προέλευσης ισούται με το λογαριασμό προορισμού.',
    'unique_account_number_for_user' => 'Φαίνεται πως αυτός ο αριθμός λογαριασμού χρησιμοποιήται ήδη.',
    'unique_iban_for_user'           => 'Φαίνεται πως αυτό το IBAN είναι ήδη σε χρήση.',
    'deleted_user'                   => 'Για λόγους ασφαλείας, δεν μπορείτε να εγγραφείτε χρησιμοποιώντας αυτή τη διεύθυνση email.',
    'rule_trigger_value'             => 'Αυτή η τιμή δεν είναι έγκυρη για την επιλεγμένη σκανδάλη.',
    'rule_action_value'              => 'Αυτή η τιμή δεν είναι έγκυρη για την επιλεγμένη ενέργεια.',
    'file_already_attached'          => 'Το μεταφορτωμένο αρχείο ":name" είναι ήδη συννημένο σε αυτό το αντικείμενο.',
    'file_attached'                  => 'Επιτυχής μεταφόρτωση του αρχείου ":name.',
    'must_exist'                     => 'Το αναγνωριστικό στο πεδίο :attribute δεν υπάρχει στη βάση δεδομένων.',
    'all_accounts_equal'             => 'Όλοι οι λογαριασμοί σε αυτό το πεδίο πρέπει να είναι ίσοι.',
    'group_title_mandatory'          => 'Ένας τίτλος ομάδας είναι υποχρεωτικός όταν υπάρχουν περισσότερες από μία συναλλαγές.',
    'transaction_types_equal'        => 'Όλοι οι διαχωρισμοί πρέπει να είναι ίδιου τύπου.',
    'invalid_transaction_type'       => 'Μη έγκυρος τύπος συναλλαγής.',
    'invalid_selection'              => 'Η επιλογή σας δεν είναι έγκυρη.',
    'belongs_user'                   => 'Αυτή η τιμή δεν είναι έγκυρη για αυτό το πεδίο.',
    'at_least_one_transaction'       => 'Απαιτείται τουλάχιστο μία συναλλαγή.',
    'at_least_one_repetition'        => 'Απαιτείται τουλάχιστον μία επανάληψη.',
    'require_repeat_until'           => 'Απαιτείται είτε ένας αριθμός επαναλήψεων, ή μία ημερομηνία λήξης (repeat_until). Όχι και τα δύο.',
    'require_currency_info'          => 'Το περιεχόμενο αυτού του πεδίου δεν είναι έγκυρη χωρίς νομισματικές πληροφορίες.',
    'not_transfer_account'           => 'Αυτός ο λογαριασμός δεν είναι λογαριασμός που μπορεί να χρησιμοποιηθεί για συναλλαγές.',
    'require_currency_amount'        => 'Το περιεχόμενο αυτού του πεδίου δεν είναι έγκυρο χωρίς πληροφορίες ετερόχθονος ποσού.',
    'equal_description'              => 'Η περιγραφή της συναλλαγής δεν πρέπει να ισούται με καθολική περιγραφή.',
    'file_invalid_mime'              => 'Το αρχείο ":name" είναι τύπου ":mime" που δεν είναι αποδεκτός ως νέας μεταφόρτωσης.',
    'file_too_large'                 => 'Το αρχείο ":name" είναι πολύ μεγάλο.',
    'belongs_to_user'                => 'Η τιμή του :attribute είναι άγνωστη.',
    'accepted'                       => 'Το :attribute πρέπει να γίνει αποδεκτό.',
    'bic'                            => 'Αυτό δεν είναι έγκυρο IBAN.',
    'at_least_one_trigger'           => 'Ο κανόνας πρέπει να έχει τουλάχιστον μία σκανδάλη.',
    'at_least_one_action'            => 'Ο κανόνας πρέπει να έχει τουλάχιστον μία λειτουργία.',
    'base64'                         => 'Αυτά δεν είναι έγκυρα base64 κωδικοποιημένα δεδομένα.',
    'model_id_invalid'               => 'Το παραχωρημένο αναγνωριστικό δε φαίνεται έγκυρο για αυτό το μοντέλο.',
    'more'                           => ':attribute πρέπει να είναι μεγαλύτερο από ":more".',
    'less'                           => 'Το :attribute πρέπει να είναι μικρότερο από 10,000,000',
    'active_url'                     => 'Το :attribute δεν είναι έγκυρο URL.',
    'after'                          => 'Το :attribute πρέπει να είναι ημερομηνία μετά από :date.',
    'alpha'                          => 'Το :attribute μπορεί να περιέχει μόνο γράμματα.',
    'alpha_dash'                     => 'Το :attribute μπορεί να περιέχει γράμματα, αριθμοί, και παύλες.',
    'alpha_num'                      => 'Το :attribute μπορεί να περιέχει γράμματα και αριθμούς.',
    'array'                          => 'Το :attribute πρέπει να είναι μία παράταξη.',
    'unique_for_user'                => 'Υπάρχει ήδη μια εισαγωγή με αυτό το :attribute.',
    'before'                         => 'Αυτό το :attribute πρέπει να είναι μια ημερομηνία πρίν από :date.',
    'unique_object_for_user'         => 'Αυτό το όνομα είναι ήδη σε χρήση.',
    'unique_account_for_user'        => 'Αυτό το όνομα λογαριασμού είναι ήδη σε χρήση.',
    'between.numeric'                => 'Το :attribute πρέπει να είναι μεταξύ :min και :max.',
    'between.file'                   => 'Το :attribute πρέπει να είναι μεταξύ :min και :max kilobytes.',
    'between.string'                 => 'To :attribute πρέπει να είναι μεταξύ :min και :max χαρακτήρων.',
    'between.array'                  => 'Το :attribute πρέπει να είναι μεταξύ :min και :max αντικειμένων.',
    'boolean'                        => 'Το πεδίο :attribute πρέπει να είναι αληθές ή ψευδές.',
    'confirmed'                      => 'Η επιβεβαίωση του :attribute δεν ταιριάζει.',
    'date'                           => 'Το :attribute δεν είναι έγκυρη ημερομηνία.',
    'date_format'                    => 'Το :attribute δεν ταιριάζει με τη μορφή :format.',
    'different'                      => 'Το :attribute και :other πρέπει να είναι διαφορετικά.',
    'digits'                         => 'Το :attribute πρέπει να είναι :digits ψηφία.',
    'digits_between'                 => 'Το :attribute πρέπει να είναι μεταξύ :min και :max ψηφίων.',
    'email'                          => 'Το :attribute πρέπει να είναι μία έγκυρη διεύθυνση email.',
    'filled'                         => 'Το πεδίο :attribute είναι απαραίτητο.',
    'exists'                         => 'Το επιλεγμένο :attribute δεν είναι έγκυρο.',
    'image'                          => 'Το :attribute πρέπει να είναι εικόνα.',
    'in'                             => 'Το επιλεγμένο :attribute δεν είναι έγκυρο.',
    'integer'                        => 'Το :attribute πρέπει να είναι ακέραιος αριθμός.',
    'ip'                             => 'Το :attribute πρέπει να είναι έγκυρη διεύθυνση IP.',
    'json'                           => 'Το :attribute πρέπει να είναι έγκυρο JSON string.',
    'max.numeric'                    => 'Το :attribute δεν μπορεί να είναι μεγαλύτερο του :max.',
    'max.file'                       => 'Το :attribute δεν μπορεί να είναι μεγαλύτερο από :max kilobytes.',
    'max.string'                     => 'Το :attribute δεν μπορεί να είναι μεγαλύτερο από :max χαρακτήρες.',
    'max.array'                      => 'Το :attribute δεν μπορεί να έχει περισσότερα από :max αντικείμενα.',
    'mimes'                          => 'Το :attribute πρέπει να είναι ένα αρχείου τύπου: :values.',
    'min.numeric'                    => 'Το :attribute πρέπει να είναι τουλάχιστον :min.',
    'lte.numeric'                    => 'Το :attribute πρέπει να είναι μικρότερο ή ίσο του :value.',
    'min.file'                       => 'Το :attribute πρέπει είναι τουλάχιστον :min kilobytes.',
    'min.string'                     => 'Το :attribute πρέπει να είναι τουλάχιστον :min χαρακτήρες.',
    'min.array'                      => 'Το :attribute πρέπει να είναι τουλάχιστον :min αντικείμενα.',
    'not_in'                         => 'Το επιλεγμένο :attribute δεν είναι έγκυρο.',
    'numeric'                        => 'Το :attribute πρέπει να είναι αριθμός.',
    'numeric_native'                 => 'Το εγχώριο ποσό πρέπει να είναι αριθμός.',
    'numeric_destination'            => 'Το ποσό προορισμού πρέπει να είναι αριθμός.',
    'numeric_source'                 => 'Το ποσό προέλευσης πρέπει να είναι αριθμός.',
    'regex'                          => 'Η μορφή του :attribute δεν είναι έγκυρη.',
    'required'                       => 'Το πεδίο :attribute είναι απαραίτητο.',
    'required_if'                    => 'Το πεδίο :attribute απαιτείται όταν το :other είναι :value.',
    'required_unless'                => 'Το πεδίο :attribute είναι απαραίτητο εκτός αν το :other είναι σε :values.',
    'required_with'                  => 'Το πεδίο :attribute είναι απαραίτητο όταν :values είναι παρούσες.',
    'required_with_all'              => 'Το πεδίο :attribute είναι απαραίτητο όταν :values είναι παρούσες.',
    'required_without'               => 'To πεδίο :attribute είναι απαραίτητο όταν :values δεν είναι παρούσες.',
    'required_without_all'           => 'Το πεδίο :attribute είναι απαραίτητο όταν καμία από :values είναι δεν είναι παρούσες.',
    'same'                           => 'Τα :attribute και :other πρέπει να ταιριάζουν.',
    'size.numeric'                   => 'Το :attribute πρέπει να είναι :size.',
    'amount_min_over_max'            => 'Το ελάχιστο ποσό δεν μπορεί να είναι μεγαλύτερο του μέγιστου ποσού.',
    'size.file'                      => 'Το :attribute πρέπει να είναι :size kilobytes.',
    'size.string'                    => 'Το :attribute πρέπει να είναι :size χαρακτήρες.',
    'size.array'                     => 'Το :attribute πρέπει να περιέχει :size αντικείμενα.',
    'unique'                         => 'Το :attribute έχει ληφθεί ήδη.',
    'string'                         => 'Το :attribute πρέπει να είναι string.',
    'url'                            => 'Η μορφή :attribute δεν είναι έγκυρη.',
    'timezone'                       => 'Το :attribute πρέπει να είναι έγκυρη ζώνη.',
    '2fa_code'                       => 'Το πεδίο :attribute δεν είναι έγκυρο.',
    'dimensions'                     => 'Το :attribute δεν έχει έγκυρες διαστάσεις εικόνας.',
    'distinct'                       => 'Το πεδίο :attribute έχει διπλότυπη τιμή.',
    'file'                           => 'Το :attribute πρέπει να είναι ένα αρχείο.',
    'in_array'                       => 'Το πεδίο :attribute δεν υπάρχει σε :other.',
    'present'                        => 'Το πεδίο :attribute πρέπει να είναι παρόν.',
    'amount_zero'                    => 'Το συνολικό ποσό δεν μπορεί να είναι μηδέν.',
    'current_target_amount'          => 'Το τρέχων ποσό πρέπει να είναι μικρότερο από το ποσό προορισμού.',
    'unique_piggy_bank_for_user'     => 'Το όνομα του κουμπαρά πρέπει να είναι μοναδικό.',
    'secure_password'                => 'Αυτό δεν είναι ασφαλές συνθηματικό. Παρακαλώ δοκιμάστε ξανά. Για περισσότερες πληροφορίες επισκεφτείτε https://bit.ly/FF3-password-security',
    'valid_recurrence_rep_type'      => 'Μη έγκυρος τύπος επανάληψης για επαναλαμβανόμενες συναλλαγές.',
    'valid_recurrence_rep_moment'    => 'Μη έγκυρη στιγμή επανάληψης για αυτό τον τύπο επανάληψης.',
    'invalid_account_info'           => 'Μη έγκυρες πληροφορίες λογαριασμού.',
    'attributes'                     => [
        'email'                   => 'διεύθυνση email',
        'description'             => 'περιγραφή',
        'amount'                  => 'ποσό',
        'name'                    => 'όνομα',
        'piggy_bank_id'           => 'αναγνωριστικό κουμπαρά',
        'targetamount'            => 'ποσό προορισμού',
        'opening_balance_date'    => 'ημερομηνία ισολογισμού έναρξης',
        'opening_balance'         => 'ισολογισμός έναρξης',
        'match'                   => 'αντιστοίχιση',
        'amount_min'              => 'ελάχιστο ποσό',
        'amount_max'              => 'μέγιστο ποσό',
        'title'                   => 'τίτλος',
        'tag'                     => 'ετικέτα',
        'transaction_description' => 'περιγραφή συναλλαγής',
        'rule-action-value.1'     => 'τιμή ενέργειας κανόνα #1',
        'rule-action-value.2'     => 'τιμή ενέργειας κανόνα #2',
        'rule-action-value.3'     => 'τιμή ενέργειας κανόνα #3',
        'rule-action-value.4'     => 'τιμή ενέργειας κανόνα #4',
        'rule-action-value.5'     => 'τιμή ενέργειας κανόνα #5',
        'rule-action.1'           => 'ενέργεια κανόνα #1',
        'rule-action.2'           => 'ενέργεια κανόνα #2',
        'rule-action.3'           => 'ενέργεια κανόνα #3',
        'rule-action.4'           => 'ενέργεια κανόνα #4',
        'rule-action.5'           => 'ενέργεια κανόνα #5',
        'rule-trigger-value.1'    => 'τιμή σκανδάλης κανόνα #1',
        'rule-trigger-value.2'    => 'τιμή σκανδάλης κανόνα #2',
        'rule-trigger-value.3'    => 'τιμή σκανδάλης κανόνα #3',
        'rule-trigger-value.4'    => 'τιμή σκανδάλης κανόνα #4',
        'rule-trigger-value.5'    => 'τιμή σκανδάλης κανόνα #5',
        'rule-trigger.1'          => 'σκανδάλη κανόνα #1',
        'rule-trigger.2'          => 'σκανδάλη κανόνα #2',
        'rule-trigger.3'          => 'σκανδάλη κανόνα #3',
        'rule-trigger.4'          => 'σκανδάλη κανόνα #4',
        'rule-trigger.5'          => 'σκανδάλη κανόνα #5',
    ],

    // validation of accounts:
    'withdrawal_source_need_data'    => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό λογαριασμού προέλευσης και/ή ένα έγκυρο όνομα λογαριασμού προέλευσης για να συνεχίσετε.',
    'withdrawal_source_bad_data'     => 'Δεν μπορεί να βρεθεί έγκυρος λογαριασμός προέλευσης κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',
    'withdrawal_dest_need_data'      => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό ID λογαριασμού προέλευσης και/ή ένα έγκυρο όνομα λογαριασμού προορισμού για να συνεχίσετε.',
    'withdrawal_dest_bad_data'       => 'Δεν μπορεσε να βρεθεί έγκυρος λογαριασμός προορισμού κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',

    'deposit_source_need_data' => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό ID λογαριασμού προέλευσης και/ή ένα έγκυρο όνομα λογαριασμού προέλευσης για να συνεχίσετε.',
    'deposit_source_bad_data'  => 'Δεν μπόρεσε να βρεθεί ένας έγκυρος λογαριασμός προέλευσης κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',
    'deposit_dest_need_data'   => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό ID λογαριασμού προορισμού και/ή ένα έγκυρο όνομα λογαριασμού προορισμού για να συνεχίσετε.',
    'deposit_dest_bad_data'    => 'Δεν μπόρεσε να βρεθεί έγκυρος λογαριασμός προορισμού κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',
    'deposit_dest_wrong_type'  => 'O υποβεβλημένος λογαριασμός προέλευσης δεν είναι σωστού τύπου.',

    'transfer_source_need_data' => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό λογαριασμού προέλευσης και/ή ένα έγκυρο όνομα λογαριασμού προέλευσης για να συνεχίσετε.',
    'transfer_source_bad_data'  => 'Δεν μπορεσε να βρεθεί ένας έγκυρος λογαριασμός προέλευσης κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',
    'transfer_dest_need_data'   => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό ID λογαριασμού προορισμού και/ή ένα έγκυρο όνομα λογαριασμού προορισμού για να συνεχίσετε.',
    'transfer_dest_bad_data'    => 'Δεν μπορεσε να βρεθεί έγκυρος λογαριασμός προορισμού κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',
    'need_id_in_edit'           => 'Κάθε διαχωρισμός πρέπει να έχει transaction_journal_id (είτε έγκυρο αναγνωριστικό ID ή 0).',

    'ob_source_need_data' => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό λογαριασμού προέλευσης και/ή ένα έγκυρο όνομα λογαριασμού προέλευσης για να συνεχίσετε.',
    'ob_dest_need_data'   => 'Πρέπει να λάβετε ένα έγκυρο αναγνωριστικό ID λογαριασμού προορισμού και/ή ένα έγκυρο όνομα λογαριασμού προορισμού για να συνεχίσετε.',
    'ob_dest_bad_data'    => 'Δεν μπορεσε να βρεθεί έγκυρος λογαριασμός προορισμού κατά την αναζήτηση του αναγνωριστικού ID ":id" ή του ονόματος ":name".',

    'generic_invalid_source'      => 'Δεν μπορείτε να χρησιμοποιήσετε αυτό το λογαριασμό ως λογαριασμό προέλευσης.',
    'generic_invalid_destination' => 'Δεν μπορείτε να χρησιμοποιήσετε αυτό το λογαριασμό ως λογαριασμό προορισμού.',

    'gte.numeric' => 'Το :attribute πρέπει να είναι μεγαλύτερο ή ίσο με :value.',
    'gte.file'    => 'Το :attribute πρέπει να είναι μεγαλύτερο ή ίσο με :value kilobytes.',
    'gte.string'  => 'Το :attribute πρέπει να είναι μεγαλύτερο ή ίσο με :value χαρακτήρες.',
    'gte.array'   => 'Το :attribute πρέπει να έχει :value αντικείμενα ή παραπάνω.',
];
