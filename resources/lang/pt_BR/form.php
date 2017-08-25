<?php
declare(strict_types=1);

/**
 * form.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms of the
 * Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */

return [

    // new user:
    'bank_name'                      => 'Nome do banco',
    'bank_balance'                   => 'Saldo',
    'savings_balance'                => 'Salda da Poupança',
    'credit_card_limit'              => 'Limite do Cartão de Crédito',
    'automatch'                      => 'Equivale automaticamente',
    'skip'                           => 'Pular',
    'name'                           => 'Nome',
    'active'                         => 'Ativar',
    'amount_min'                     => 'Valor Mínimo',
    'amount_max'                     => 'Valor Máximo',
    'match'                          => 'Corresponde em',
    'repeat_freq'                    => 'Repetições',
    'journal_currency_id'            => 'Moeda',
    'currency_id'                    => 'Moeda',
    'attachments'                    => 'Anexos',
    'journal_amount'                 => 'Quantia',
    'journal_asset_source_account'   => 'Conta de ativo (fonte)',
    'journal_source_account_name'    => 'Conta de receita (fonte)',
    'journal_source_account_id'      => 'Conta de ativo (fonte)',
    'BIC'                            => 'BIC',
    'verify_password'                => 'Verify password security',
    'account_from_id'                => 'da conta',
    'account_to_id'                  => 'para conta',
    'source_account'                 => 'Conta de origem',
    'destination_account'            => 'Conta de destino',
    'journal_destination_account_id' => 'Conta de ativo (destino)',
    'asset_destination_account'      => 'Conta de ativo (destino)',
    'asset_source_account'           => 'Conta de ativo (fonte)',
    'journal_description'            => 'Descrição',
    'note'                           => 'Notas',
    'split_journal'                  => 'Dividir essa transação',
    'split_journal_explanation'      => 'Dividir essa transação em várias partes',
    'currency'                       => 'Moeda',
    'account_id'                     => 'Conta de ativo',
    'budget_id'                      => 'Orçamento',
    'openingBalance'                 => 'Saldo inicial',
    'tagMode'                        => 'Modo de tag',
    'tagPosition'                    => 'Localização de tag',
    'virtualBalance'                 => 'Saldo virtual',
    'longitude_latitude'             => 'Localização',
    'targetamount'                   => 'Valor alvo',
    'accountRole'                    => 'Tipo de conta',
    'openingBalanceDate'             => 'Data do Saldo inicial',
    'ccType'                         => 'Plano de pagamento do Cartão de Crédito',
    'ccMonthlyPaymentDate'           => 'Data do pagamento mensal do Cartão de Crédito',
    'piggy_bank_id'                  => 'Cofrinho',
    'returnHere'                     => 'Retornar aqui',
    'returnHereExplanation'          => 'Depois de armazenar, retorne aqui para criar outro.',
    'returnHereUpdateExplanation'    => 'Depois da atualização, retorne aqui',
    'description'                    => 'Descrição',
    'expense_account'                => 'Conta de Despesa',
    'revenue_account'                => 'Conta de Receita',
    'decimal_places'                 => 'Casas décimais',
    'exchange_rate_instruction'      => 'Moedas estrangeiras',
    'exchanged_amount'               => 'Exchanged amount',
    'source_amount'                  => 'Amount (source)',
    'destination_amount'             => 'Amount (destination)',
    'native_amount'                  => 'Native amount',

    'revenue_account_source'      => 'Conta de receita (fonte)',
    'source_account_asset'        => 'Conta de origem (conta de ativo)',
    'destination_account_expense' => 'Conta de destino (conta de despesa)',
    'destination_account_asset'   => 'Conta de destino (conta de ativo)',
    'source_account_revenue'      => 'Conta de origem (conta de receita)',
    'type'                        => 'Tipo',
    'convert_Withdrawal'          => 'Converter a retirada',
    'convert_Deposit'             => 'Converter o depósito',
    'convert_Transfer'            => 'Converter a transferência',


    'amount'                     => 'Valor',
    'date'                       => 'Data',
    'interest_date'              => 'Data de interesse',
    'book_date'                  => 'Data reserva',
    'process_date'               => 'Data de processamento',
    'category'                   => 'Categoria',
    'tags'                       => 'Etiquetas',
    'deletePermanently'          => 'Apagar permanentemente',
    'cancel'                     => 'Cancelar',
    'targetdate'                 => 'Data Alvo',
    'tag'                        => 'Etiqueta',
    'under'                      => 'Debaixo',
    'symbol'                     => 'Símbolo',
    'code'                       => 'Código',
    'iban'                       => 'IBAN',
    'accountNumber'              => 'Número de conta',
    'has_headers'                => 'Cabeçalhos',
    'date_format'                => 'Formato da Data',
    'specifix'                   => 'Banco- ou arquivo específico corrigídos',
    'attachments[]'              => 'Anexos',
    'store_new_withdrawal'       => 'Armazenar nova retirada',
    'store_new_deposit'          => 'Armazenar novo depósito',
    'store_new_transfer'         => 'Armazenar nova transferência',
    'add_new_withdrawal'         => 'Adicionar uma nova retirada',
    'add_new_deposit'            => 'Adicionar um novo depósito',
    'add_new_transfer'           => 'Adicionar uma nova transferência',
    'noPiggybank'                => '(nenhum cofrinho)',
    'title'                      => 'Título',
    'notes'                      => 'Notas',
    'filename'                   => 'Nome do arquivo',
    'mime'                       => 'Tipo do Arquivo (MIME)',
    'size'                       => 'Tamanho',
    'trigger'                    => 'Disparo',
    'stop_processing'            => 'Parar processamento',
    'start_date'                 => 'Início do intervalo',
    'end_date'                   => 'Final do intervalo',
    'export_start_range'         => 'Início do intervalo de exportação',
    'export_end_range'           => 'Fim do intervalo de exportação',
    'export_format'              => 'Formato do arquivo',
    'include_attachments'        => 'Incluir anexos enviados',
    'include_old_uploads'        => 'Incluir dados importados',
    'accounts'                   => 'Exportar transações destas contas',
    'delete_account'             => 'Apagar conta ":name"',
    'delete_bill'                => 'Apagar fatura ":name"',
    'delete_budget'              => 'Excluir o orçamento ":name"',
    'delete_category'            => 'Excluir categoria ":name"',
    'delete_currency'            => 'Excluir moeda ":moeda"',
    'delete_journal'             => 'Excluir a transação com a descrição ":description"',
    'delete_attachment'          => 'Apagar anexo ":name"',
    'delete_rule'                => 'Excluir regra ":title"',
    'delete_rule_group'          => 'Exclua o grupo de regras ":title"',
    'delete_link_type'           => 'Delete link type ":name"',
    'attachment_areYouSure'      => 'Tem certeza que deseja excluir o anexo denominado ":name"?',
    'account_areYouSure'         => 'Tem certeza que deseja excluir a conta denominada ":name"?',
    'bill_areYouSure'            => 'Você tem certeza que quer apagar a fatura ":name"?',
    'rule_areYouSure'            => 'Tem certeza que deseja excluir a regra intitulada ":title"?',
    'ruleGroup_areYouSure'       => 'Tem certeza que deseja excluir o grupo de regras intitulado ":title"?',
    'budget_areYouSure'          => 'Tem certeza que deseja excluir o orçamento chamado ":name"?',
    'category_areYouSure'        => 'Tem certeza que deseja excluir a categoria com o nome ":name"?',
    'currency_areYouSure'        => 'Tem certeza que deseja excluir a moeda chamada ":name"?',
    'piggyBank_areYouSure'       => 'Tem certeza que deseja excluir o cofrinho chamado ":name"?',
    'journal_areYouSure'         => 'Tem certeza que deseja excluir a transação descrita ":description"?',
    'mass_journal_are_you_sure'  => 'Tem a certeza que pretende apagar estas transações?',
    'tag_areYouSure'             => 'Você tem certeza que quer apagar a tag ":tag"?',
    'journal_link_areYouSure'    => 'Are you sure you want to delete the link between <a href=":source_link">:source</a> and <a href=":destination_link">:destination</a>?',
    'linkType_areYouSure'        => 'Are you sure you want to delete the link type ":name" (":inward" / ":outward")?',
    'permDeleteWarning'          => 'Exclusão de dados do Firely são permanentes e não podem ser desfeitos.',
    'mass_make_selection'        => 'Você ainda pode evitar que itens sejam excluídos, removendo a caixa de seleção.',
    'delete_all_permanently'     => 'Exclua os selecionados permanentemente',
    'update_all_journals'        => 'Atualizar essas transações',
    'also_delete_transactions'   => 'A única transação ligada a essa conta será excluída também.|Todas as :count transações ligadas a esta conta serão excluídas também.',
    'also_delete_connections'    => 'The only transaction linked with this link type will lose this connection.|All :count transactions linked with this link type will lose their connection.',
    'also_delete_rules'          => 'A única regra que ligado a este grupo de regras será excluída também.|Todos as :count regras ligadas a este grupo de regras serão excluídas também.',
    'also_delete_piggyBanks'     => 'O único cofrinho conectado a essa conta será excluído também.|Todos os :count cofrinhos conectados a esta conta serão excluídos também.',
    'bill_keep_transactions'     => 'A única transação a esta conta não será excluída.|Todos as :count transações conectadas a esta fatura não serão excluídos.',
    'budget_keep_transactions'   => 'A única transação conectada a este orçamento não será excluída.|Todos :count transações ligadas a este orçamento não serão excluídos.',
    'category_keep_transactions' => 'A única transação ligada a esta categoria não será excluída.|Todos :count transações ligadas a esta categoria não serão excluídos.',
    'tag_keep_transactions'      => 'A única transação ligada a essa marca não será excluída.|Todos :count transações ligadas a essa marca não serão excluídos.',

    'email'                 => 'E-mail',
    'password'              => 'Senha',
    'password_confirmation' => 'Senha(Confirmar)',
    'blocked'               => 'Está bloqueado?',
    'blocked_code'          => 'Reason for block',


    // admin
    'domain'                => 'Domínio',
    'single_user_mode'      => 'Modo de usuário único',
    'must_confirm_account'  => 'Novos usuários devem ativar a conta',
    'is_demo_site'          => 'É o site de demonstração',


    // import
    'import_file'           => 'Importar arquivo',
    'configuration_file'    => 'Arquivo de configuração',
    'import_file_type'      => 'Tipo de arquivo de importação',
    'csv_comma'             => 'Uma vírgula (,)',
    'csv_semicolon'         => 'Um ponto e vírgula (;)',
    'csv_tab'               => 'Um Tab (invisível)',
    'csv_delimiter'         => 'Delimitador de campo CSV',
    'csv_import_account'    => 'Conta de importação padrão',
    'csv_config'            => 'Importar CSV de configuração',


    'due_date'           => 'Data de vencimento',
    'payment_date'       => 'Data de pagamento',
    'invoice_date'       => 'Data da Fatura',
    'internal_reference' => 'Referência interna',

    'inward'  => 'Inward description',
    'outward' => 'Outward description',
];