<?php
/**
 * form.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
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

return [
    // new user:
    'bank_name'                      => 'Name der Bank',
    'bank_balance'                   => 'Kontostand',
    'savings_balance'                => 'Sparguthaben',
    'credit_card_limit'              => 'Kreditkartenlimit',
    'automatch'                      => 'Automatisch reagieren',
    'skip'                           => 'Überspringen',
    'name'                           => 'Name',
    'active'                         => 'Aktiv',
    'amount_min'                     => 'Mindestbetrag',
    'amount_max'                     => 'Höchstbetrag',
    'match'                          => 'Reagiert auf',
    'repeat_freq'                    => 'Wiederholungen',
    'journal_currency_id'            => 'Währung',
    'currency_id'                    => 'Währung',
    'attachments'                    => 'Anhänge',
    'journal_amount'                 => 'Betrag',
    'journal_source_account_name'    => 'Kreditor (Quelle)',
    'journal_source_account_id'      => 'Bestandskonto (Quelle)',
    'BIC'                            => 'BIC',
    'verify_password'                => 'Passwortsicherheit überprüfen',
    'source_account'                 => 'Quellkonto',
    'destination_account'            => 'Zielkonto',
    'journal_destination_account_id' => 'Bestandskonto (Ziel)',
    'asset_destination_account'      => 'Bestandskonto (Ziel)',
    'asset_source_account'           => 'Bestandskonto (Quelle)',
    'journal_description'            => 'Beschreibung',
    'note'                           => 'Notizen',
    'split_journal'                  => 'Diese Überweisung aufteilen',
    'split_journal_explanation'      => 'Diese Überweisung in mehrere Teile aufteilen',
    'currency'                       => 'Währung',
    'account_id'                     => 'Girokonto',
    'budget_id'                      => 'Kostenrahmen',
    'openingBalance'                 => 'Eröffnungsbilanz',
    'tagMode'                        => 'Tag-Modus',
    'tag_position'                   => 'Schlagwort-Speicherort',
    'virtualBalance'                 => 'Virtueller Kontostand',
    'targetamount'                   => 'Zielbetrag',
    'accountRole'                    => 'Rolle des Kontos',
    'openingBalanceDate'             => 'Eröffnungsbilanzdatum',
    'ccType'                         => 'Zahlungsplan der Kreditkarte',
    'ccMonthlyPaymentDate'           => 'Monatliches Zahlungsdatum der Kreditkarte',
    'piggy_bank_id'                  => 'Sparschwein',
    'returnHere'                     => 'Hierhin zurückkehren',
    'returnHereExplanation'          => 'Nach dem Speichern hierher zurückkehren, um ein weiteres Element zu erstellen.',
    'returnHereUpdateExplanation'    => 'Nach dem Update, hierher zurückkehren.',
    'description'                    => 'Beschreibung',
    'expense_account'                => 'Debitor (Ausgabe)',
    'revenue_account'                => 'Kreditor (Einnahme)',
    'decimal_places'                 => 'Nachkommastellen',
    'exchange_rate_instruction'      => 'Fremdwährungen',
    'source_amount'                  => 'Betrag (Quelle)',
    'destination_amount'             => 'Betrag (Ziel)',
    'native_amount'                  => 'Nativer Betrag',
    'new_email_address'              => 'Neue E-Mail-Adresse',
    'verification'                   => 'Bestätigung',
    'api_key'                        => 'API-Schlüssel',
    'remember_me'                    => 'Angemeldet bleiben',

    'source_account_asset'        => 'Quellkonto (Bestandskonto)',
    'destination_account_expense' => 'Zielkonto (Unkostenkonto)',
    'destination_account_asset'   => 'Zielkonto (Bestandskonto)',
    'source_account_revenue'      => 'Quellkonto (Ertragskonto)',
    'type'                        => 'Typ',
    'convert_Withdrawal'          => 'Ändere zu Abhebung',
    'convert_Deposit'             => 'Ändere zu Einzahlung',
    'convert_Transfer'            => 'In Umbuchung umwandeln',

    'amount'                     => 'Betrag',
    'date'                       => 'Datum',
    'interest_date'              => 'Zinstermin',
    'book_date'                  => 'Buchungsdatum',
    'process_date'               => 'Bearbeitungsdatum',
    'category'                   => 'Kategorie',
    'tags'                       => 'Schlagwörter',
    'deletePermanently'          => 'Dauerhaft löschen',
    'cancel'                     => 'Abbrechen',
    'targetdate'                 => 'Zieldatum',
    'startdate'                  => 'Startdatum',
    'tag'                        => 'Schlagwort',
    'under'                      => 'Unter',
    'symbol'                     => 'Zeichen',
    'code'                       => 'Code',
    'iban'                       => 'IBAN',
    'accountNumber'              => 'Kontonummer',
    'creditCardNumber'           => 'Kreditkartennummer',
    'has_headers'                => 'Kopfzeilen',
    'date_format'                => 'Datumsformat',
    'specifix'                   => 'Bank- oder Dateispezifischer Korrekturen',
    'attachments[]'              => 'Anhänge',
    'store_new_withdrawal'       => 'Speichere neue Ausgabe',
    'store_new_deposit'          => 'Speichere neue Einnahme',
    'store_new_transfer'         => 'Neue Umbuchung speichern',
    'add_new_withdrawal'         => 'Fügen Sie eine neue Ausgabe hinzu',
    'add_new_deposit'            => 'Fügen Sie eine neue Einnahme hinzu',
    'add_new_transfer'           => 'Neue Umbuchung anlegen',
    'title'                      => 'Titel',
    'notes'                      => 'Notizen',
    'filename'                   => 'Dateiname',
    'mime'                       => 'MIME-Typ',
    'size'                       => 'Größe',
    'trigger'                    => 'Auslöser',
    'stop_processing'            => 'Verarbeitung beenden',
    'start_date'                 => 'Anfang des Bereichs',
    'end_date'                   => 'Ende des Bereichs',
    'export_start_range'         => 'Beginn des Exportbereichs',
    'export_end_range'           => 'Ende des Exportbereichs',
    'export_format'              => 'Dateiformat',
    'include_attachments'        => 'Hochgeladene Anhänge hinzufügen',
    'include_old_uploads'        => 'Importierte Daten hinzufügen',
    'accounts'                   => 'Exportiere die Überweisungen von diesem Konto',
    'delete_account'             => 'Lösche Konto ":name"',
    'delete_bill'                => 'Lösche Rechnung ":name"',
    'delete_budget'              => 'Kostenrahmen „:name” löschen',
    'delete_category'            => 'Lösche Kategorie ":name"',
    'delete_currency'            => 'Lösche Währung ":name"',
    'delete_journal'             => 'Lösche Überweisung mit Beschreibung ":description"',
    'delete_attachment'          => 'Lösche Anhang ":name"',
    'delete_rule'                => 'Lösche Regel ":title"',
    'delete_rule_group'          => 'Lösche Regelgruppe ":title"',
    'delete_link_type'           => 'Verknüpfungstyp „:name” löschen',
    'delete_user'                => 'Benutzer ":email" löschen',
    'user_areYouSure'            => 'Wenn Sie den Benutzer ":email" löschen, ist alles weg. Es gibt keine Sicherung, Wiederherstellung oder ähnliches. Wenn Sie sich selbst löschen, verlieren Sie den Zugriff auf diese Instanz von Firefly III.',
    'attachment_areYouSure'      => 'Sind Sie sicher, dass Sie den Anhang ":name" löschen möchten?',
    'account_areYouSure'         => 'Sind Sie sicher, dass Sie das Konto ":name" löschen möchten?',
    'bill_areYouSure'            => 'Sind Sie sicher, dass Sie die Rechnung ":name" löschen möchten?',
    'rule_areYouSure'            => 'Sind Sie sicher, dass Sie die Regel mit dem Titel ":title" löschen möchten?',
    'ruleGroup_areYouSure'       => 'Sind Sie sicher, dass sie die Regelgruppe ":title" löschen möchten?',
    'budget_areYouSure'          => 'Möchten Sie den Kostenrahmen „:name” wirklich löschen?',
    'category_areYouSure'        => 'Sind Sie sicher, dass Sie die Kategorie ":name" löschen möchten?',
    'currency_areYouSure'        => 'Sind Sie sicher, dass Sie die Währung ":name" löschen möchten?',
    'piggyBank_areYouSure'       => 'Sind Sie sicher, dass Sie das Sparschwein ":name" löschen möchten?',
    'journal_areYouSure'         => 'Sind Sie sicher, dass Sie die Überweisung mit dem Namen ":description" löschen möchten?',
    'mass_journal_are_you_sure'  => 'Sind Sie sicher, dass Sie diese Überweisung löschen möchten?',
    'tag_areYouSure'             => 'Sind Sie sicher, dass Sie den Tag ":name" löschen möchten?',
    'journal_link_areYouSure'    => 'Sind Sie sicher, dass Sie die Verknüpfung zwischen <a href=":source_link">:source</a> und <a href=":destination_link">:destination</a> löschen möchten?',
    'linkType_areYouSure'        => 'Möchten Sie den Verknüpfungstyp „:name” („:inward”/„:outward”) wirklich löschen?',
    'permDeleteWarning'          => 'Das Löschen von Dingen in Firefly III ist dauerhaft und kann nicht rückgängig gemacht werden.',
    'mass_make_selection'        => 'Sie können das Löschen von Elementen verhindern, indem Sie die Checkbox entfernen.',
    'delete_all_permanently'     => 'Ausgewähltes dauerhaft löschen',
    'update_all_journals'        => 'Diese Transaktionen aktualisieren',
    'also_delete_transactions'   => 'Die einzige Überweisung, die mit diesem Konto verknüpft ist, wird ebenfalls gelöscht. | Alle :count Überweisungen, die mit diesem Konto verknüpft sind, werden ebenfalls gelöscht.',
    'also_delete_connections'    => 'Die einzige Transaktion, die mit diesem Verknüpfungstyp verknüpft ist, verliert diese Verbindung. • Alle :count Buchungen, die mit diesem Verknüpfungstyp verknüpft sind, verlieren ihre Verbindung.',
    'also_delete_rules'          => 'Die einzige Regel, die mit diesem Konto verknüpft ist, wird ebenfalls gelöscht. | Alle :count Regeln, die mit diesem Konto verknüpft sind, werden ebenfalls gelöscht.',
    'also_delete_piggyBanks'     => 'Das einzige Sparschwein, das mit diesem Konto verknüpft ist, wird ebenfalls gelöscht. | Alle :count Sparschweine, die mit diesem Konto verknüpft sind, werden ebenfalls gelöscht.',
    'bill_keep_transactions'     => 'Die einzige Überweisung, die mit dieser Rechnung verknüpft ist, wird nicht gelöscht. | Keine der :count Überweisungen, die mit dieser Rechnung verknüpft sind, werden gelöscht.',
    'budget_keep_transactions'   => 'Die einzige Buchung, die mit dieser Rechnung verknüpft ist, wird nicht gelöscht. | Keine der :count Buchungen, die mit dieser Rechnung verknüpft sind, werden gelöscht.',
    'category_keep_transactions' => 'Die eine Überweisungen, die mit dieser Kategorie verknüpft ist, wird nicht gelöscht. | Keine der :count Kategorien, die mit dieser Rechnung verknüpft sind, werden gelöscht.',
    'tag_keep_transactions'      => 'Die einzige Überweisung, die mit diesem Tag verknüpft ist, wird nicht gelöscht. | Keiner der :count Tags, die mit dieser Rechnung verknüpft sind, werden gelöscht.',
    'check_for_updates'          => 'Nach Updates suchen',

    'email'                 => 'E-Mail Adresse',
    'password'              => 'Passwort',
    'password_confirmation' => 'Passwort (wiederholen)',
    'blocked'               => 'Ist blockiert?',
    'blocked_code'          => 'Grund für Block',

    // admin
    'domain'                => 'Domain',
    'single_user_mode'      => 'Registrierung deaktivieren',
    'is_demo_site'          => 'Ist eine Demonstrationsseite',

    // import
    'import_file'           => 'Datei importieren',
    'configuration_file'    => 'Konfigurationsdatei',
    'import_file_type'      => 'Import-Dateityp',
    'csv_comma'             => 'Ein Komma (,)',
    'csv_semicolon'         => 'Ein Semikolon (;)',
    'csv_tab'               => 'Ein Tab (unsichtbar)',
    'csv_delimiter'         => 'CSV-Trennzeichen',
    'csv_import_account'    => 'Standard Import-Konto',
    'csv_config'            => 'CSV-Import Einstellungen',
    'client_id'             => 'Client-ID',
    'service_secret'        => 'Service secret',
    'app_secret'            => 'App-Secret',
    'public_key'            => 'Öffentlicher Schlüssel',
    'country_code'          => 'Ländercode',
    'provider_code'         => 'Bank oder Datenanbieter',

    'due_date'           => 'Fälligkeitstermin',
    'payment_date'       => 'Zahlungsdatum',
    'invoice_date'       => 'Rechnungsdatum',
    'internal_reference' => 'Interner Verweis',
    'inward'             => 'Inward description',
    'outward'            => 'Outward description',
    'rule_group_id'      => 'Regelgruppe',
];
