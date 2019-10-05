<?php

/**
 * form.php
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
    // new user:
    'bank_name'                   => 'Název banky',
    'bank_balance'                => 'Zůstatek',
    'savings_balance'             => 'Zůstatek úspor',
    'credit_card_limit'           => 'Limit kreditní karty',
    'automatch'                   => 'Hledat shodu automaticky',
    'skip'                        => 'Přeskočit',
    'enabled'                     => 'Zapnuto',
    'name'                        => 'Název',
    'active'                      => 'Aktivní',
    'amount_min'                  => 'Minimální částka',
    'amount_max'                  => 'Maximální částka',
    'match'                       => 'Matches on',
    'strict'                      => 'Striktní režim',
    'repeat_freq'                 => 'Repeats',
    'journal_currency_id'         => 'Měna',
    'currency_id'                 => 'Měna',
    'transaction_currency_id'     => 'Měna',
    'external_ip'                 => 'Externí IP adresa vašeho serveru',
    'attachments'                 => 'Přílohy',
    'journal_amount'              => 'Částka',
    'journal_source_name'         => 'Příjmový účet (zdroj)',
    'keep_bill_id'                => 'Bill',
    'journal_source_id'           => 'Účet aktiv (zdroj)',
    'BIC'                         => 'BIC',
    'verify_password'             => 'Ověřit odolnost hesla',
    'source_account'              => 'Zdrojový účet',
    'destination_account'         => 'Cílový účet',
    'journal_destination_id'      => 'Majetkový účet (cíl)',
    'asset_destination_account'   => 'Cílový účet',
    'include_net_worth'           => 'Zahrnout do čistého jmění',
    'asset_source_account'        => 'Zdrojový účet',
    'journal_description'         => 'Popis',
    'note'                        => 'Poznámky',
    'store_new_transaction'       => 'Uložit novou transakci',
    'split_journal'               => 'Rozúčtovat transakci',
    'split_journal_explanation'   => 'Rozdělit tuto transakci na vícero částí',
    'currency'                    => 'Měna',
    'account_id'                  => 'Účet aktiv',
    'budget_id'                   => 'Rozpočet',
    'opening_balance'             => 'Opening balance',
    'tagMode'                     => 'Režim štítku',
    'tag_position'                => 'Umístění štítku',
    'virtual_balance'             => 'Virtual balance',
    'targetamount'                => 'Cílová částka',
    'account_role'                => 'Account role',
    'opening_balance_date'        => 'Opening balance date',
    'cc_type'                     => 'Credit card payment plan',
    'cc_monthly_payment_date'     => 'Credit card monthly payment date',
    'piggy_bank_id'               => 'Pokladnička',
    'returnHere'                  => 'Vrátit sem',
    'returnHereExplanation'       => 'Po uložení, vrátit se sem pro vytvoření další.',
    'returnHereUpdateExplanation' => 'Po aktualizaci se vrátit sem.',
    'description'                 => 'Popis',
    'expense_account'             => 'Výdajový účet',
    'revenue_account'             => 'Příjmový účet',
    'decimal_places'              => 'Desetinná místa',
    'exchange_rate_instruction'   => 'Zahraniční měny',
    'source_amount'               => 'Částka (zdroj)',
    'destination_amount'          => 'Částka (cíl)',
    'native_amount'               => 'Native amount',
    'new_email_address'           => 'Nová e-mailová adresa',
    'verification'                => 'Ověření',
    'api_key'                     => 'Klíč k API',
    'remember_me'                 => 'Zapamatovat si mě',
    'liability_type_id'           => 'Typ závazku',
    'interest'                    => 'Úrok',
    'interest_period'             => 'Úrokové období',

    'source_account_asset'        => 'Zdrojový účet (účet aktiv)',
    'destination_account_expense' => 'Cílový účet (výdajový účet)',
    'destination_account_asset'   => 'Cílový účet (účet aktiv)',
    'source_account_revenue'      => 'Zdrojový účet (příjmový účet)',
    'type'                        => 'Typ',
    'convert_Withdrawal'          => 'Přeměnit výběr',
    'convert_Deposit'             => 'Přeměnit vklad',
    'convert_Transfer'            => 'Přeměnit převod',

    'amount'                      => 'Částka',
    'foreign_amount'              => 'Částka v cizí měně',
    'existing_attachments'        => 'Existující přílohy',
    'date'                        => 'Datum',
    'interest_date'               => 'Úrokové datum',
    'book_date'                   => 'Book date',
    'process_date'                => 'Datum zpracování',
    'category'                    => 'Kategorie',
    'tags'                        => 'Štítky',
    'deletePermanently'           => 'Nadobro smazat',
    'cancel'                      => 'Storno',
    'targetdate'                  => 'Cílové datum',
    'startdate'                   => 'Datum zahájení',
    'tag'                         => 'Štítek',
    'under'                       => 'Pod',
    'symbol'                      => 'Symbol',
    'code'                        => 'Kód',
    'iban'                        => 'IBAN',
    'account_number'              => 'Account number',
    'creditCardNumber'            => 'Číslo kreditní karty',
    'has_headers'                 => 'Hlavičky',
    'date_format'                 => 'Formát data',
    'specifix'                    => 'Opravy pro konkrétní soubor či banku',
    'attachments[]'               => 'Přílohy',
    'store_new_withdrawal'        => 'Uložit nový výběr',
    'store_new_deposit'           => 'Uložit nový vklad',
    'store_new_transfer'          => 'Uložit nový převod',
    'add_new_withdrawal'          => 'Přidat nový výběr',
    'add_new_deposit'             => 'Přidat nový vklad',
    'add_new_transfer'            => 'Přidat nový převod',
    'title'                       => 'Title',
    'notes'                       => 'Poznámky',
    'filename'                    => 'Název souboru',
    'mime'                        => 'Mime typ',
    'size'                        => 'Velikost',
    'trigger'                     => 'Spouštěč',
    'stop_processing'             => 'Zastavit zpracování',
    'start_date'                  => 'Začátek rozsahu',
    'end_date'                    => 'Konec rozsahu',
    'include_attachments'         => 'Včetně nahraných příloh',
    'include_old_uploads'         => 'Zahrnout importovaná data',
    'delete_account'              => 'Smazat účet „:name“',
    'delete_bill'                 => 'Delete bill ":name"',
    'delete_budget'               => 'Smazat rozpočet „:name“',
    'delete_category'             => 'Smazat kategorii „:name“',
    'delete_currency'             => 'Odstranit měnu „:name“',
    'delete_journal'              => 'Smazat transakci, která má popis „:description“',
    'delete_attachment'           => 'Smazat přílohu „:name“',
    'delete_rule'                 => 'Smazat pravidlo „:title“',
    'delete_rule_group'           => 'Smazat skupinu pravidel „:title“',
    'delete_link_type'            => 'Smazat odkaz typu „:name“',
    'delete_user'                 => 'Smazat uživatele „:email“',
    'delete_recurring'            => 'Smazat opakovanou transakci „:title“',
    'user_areYouSure'             => 'If you delete user ":email", everything will be gone. There is no undo, undelete or anything. If you delete yourself, you will lose access to this instance of Firefly III.',
    'attachment_areYouSure'       => 'Are you sure you want to delete the attachment named ":name"?',
    'account_areYouSure'          => 'Are you sure you want to delete the account named ":name"?',
    'bill_areYouSure'             => 'Are you sure you want to delete the bill named ":name"?',
    'rule_areYouSure'             => 'Are you sure you want to delete the rule titled ":title"?',
    'ruleGroup_areYouSure'        => 'Are you sure you want to delete the rule group titled ":title"?',
    'budget_areYouSure'           => 'Are you sure you want to delete the budget named ":name"?',
    'category_areYouSure'         => 'Are you sure you want to delete the category named ":name"?',
    'recurring_areYouSure'        => 'Are you sure you want to delete the recurring transaction titled ":title"?',
    'currency_areYouSure'         => 'Are you sure you want to delete the currency named ":name"?',
    'piggyBank_areYouSure'        => 'Opravdu smazat pokladničku se jménem ":name"?',
    'journal_areYouSure'          => 'Are you sure you want to delete the transaction described ":description"?',
    'mass_journal_are_you_sure'   => 'Are you sure you want to delete these transactions?',
    'tag_areYouSure'              => 'Are you sure you want to delete the tag ":tag"?',
    'journal_link_areYouSure'     => 'Are you sure you want to delete the link between <a href=":source_link">:source</a> and <a href=":destination_link">:destination</a>?',
    'linkType_areYouSure'         => 'Are you sure you want to delete the link type ":name" (":inward" / ":outward")?',
    'permDeleteWarning'           => 'Deleting stuff from Firefly III is permanent and cannot be undone.',
    'mass_make_selection'         => 'You can still prevent items from being deleted by removing the checkbox.',
    'delete_all_permanently'      => 'Označené trvale smazat',
    'update_all_journals'         => 'Aktualizovat tyto transakce',
    'also_delete_transactions'    => 'The only transaction connected to this account will be deleted as well.|All :count transactions connected to this account will be deleted as well.',
    'also_delete_connections'     => 'The only transaction linked with this link type will lose this connection.|All :count transactions linked with this link type will lose their connection.',
    'also_delete_rules'           => 'The only rule connected to this rule group will be deleted as well.|All :count rules connected to this rule group will be deleted as well.',
    'also_delete_piggyBanks'      => 'The only piggy bank connected to this account will be deleted as well.|All :count piggy bank connected to this account will be deleted as well.',
    'bill_keep_transactions'      => 'The only transaction connected to this bill will not be deleted.|All :count transactions connected to this bill will be spared deletion.',
    'budget_keep_transactions'    => 'The only transaction connected to this budget will not be deleted.|All :count transactions connected to this budget will be spared deletion.',
    'category_keep_transactions'  => 'The only transaction connected to this category will not be deleted.|All :count transactions connected to this category will be spared deletion.',
    'recurring_keep_transactions' => 'The only transaction created by this recurring transaction will not be deleted.|All :count transactions created by this recurring transaction will be spared deletion.',
    'tag_keep_transactions'       => 'The only transaction connected to this tag will not be deleted.|All :count transactions connected to this tag will be spared deletion.',
    'check_for_updates'           => 'Zjistit dostupnost případných aktualizací',

    'email'                 => 'E-mailová adresa',
    'password'              => 'Heslo',
    'password_confirmation' => 'Heslo (zopakování)',
    'blocked'               => 'Je blokován?',
    'blocked_code'          => 'Důvod blokování',
    'login_name'            => 'Login',

    // import
    'apply_rules'           => 'Uplatnit pravidla',
    'artist'                => 'Umělec',
    'album'                 => 'Album',
    'song'                  => 'Skladba',


    // admin
    'domain'                => 'Doména',
    'single_user_mode'      => 'Vypnout možnost registrace uživatelů',
    'is_demo_site'          => 'Je demostránka',

    // import
    'import_file'           => 'Importovat soubor',
    'configuration_file'    => 'Soubor s nastaveními',
    'import_file_type'      => 'Typ souboru k importu',
    'csv_comma'             => 'Čárka (,)',
    'csv_semicolon'         => 'Středník (;)',
    'csv_tab'               => 'Tabulátor (neviditelný)',
    'csv_delimiter'         => 'Oddělovač kolonek v CSV',
    'csv_import_account'    => 'Výchozí účet pro import',
    'csv_config'            => 'Nastavení CSV importu',
    'client_id'             => 'Identif. klienta',
    'service_secret'        => 'Service secret',
    'app_secret'            => 'App secret',
    'app_id'                => 'Identif. aplikace',
    'secret'                => 'Secret',
    'public_key'            => 'Veřejná část klíče',
    'country_code'          => 'Kód země',
    'provider_code'         => 'Banka nebo poskytovatel dat',
    'fints_url'             => 'URL adresa FinTS API',
    'fints_port'            => 'Port',
    'fints_bank_code'       => 'Kód banky',
    'fints_username'        => 'Uživatelské jméno',
    'fints_password'        => 'PIN kód / heslo',
    'fints_account'         => 'FinTS účet',
    'local_account'         => 'Účet Firefly III',
    'from_date'             => 'Od data',
    'to_date'               => 'Do data',


    'due_date'                => 'Datum splatnosti',
    'payment_date'            => 'Datum zaplacení',
    'invoice_date'            => 'Datum vystavení',
    'internal_reference'      => 'Interní reference',
    'inward'                  => 'Inward description',
    'outward'                 => 'Outward description',
    'rule_group_id'           => 'Rule group',
    'transaction_description' => 'Popis transakce',
    'first_date'              => 'První datum',
    'transaction_type'        => 'Typ transakce',
    'repeat_until'            => 'Opakovat do data',
    'recurring_description'   => 'Recurring transaction description',
    'repetition_type'         => 'Typ opakování',
    'foreign_currency_id'     => 'Zahraniční měna',
    'repetition_end'          => 'Opakování končí',
    'repetitions'             => 'Opakování',
    'calendar'                => 'Kalendář',
    'weekend'                 => 'Víkend',
    'client_secret'           => 'Client secret',

    'withdrawal_destination_id' => 'Destination account',
    'deposit_source_id'         => 'Source account',
    'expected_on'               => 'Expected on',
    'paid'                      => 'Paid',

];
