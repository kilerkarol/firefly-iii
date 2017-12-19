<?php
/**
 * validation.php
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
    'iban'                           => 'This is not a valid IBAN.',
    'unique_account_number_for_user' => 'It looks like this account number is already in use.',
    'deleted_user'                   => 'Due to security constraints, you cannot register using this email address.',
    'rule_trigger_value'             => 'This value is invalid for the selected trigger.',
    'rule_action_value'              => 'This value is invalid for the selected action.',
    'file_already_attached'          => 'Uploaded file ":name" is already attached to this object.',
    'file_attached'                  => 'Succesfully uploaded file ":name".',
    'file_invalid_mime'              => 'File ":name" is of type ":mime" which is not accepted as a new upload.',
    'file_too_large'                 => 'File ":name" is too large.',
    'belongs_to_user'                => 'The value of :attribute is unknown',
    'accepted'                       => 'The :attribute must be accepted.',
    'bic'                            => 'This is not a valid BIC.',
    'more'                           => ':attribute must be larger than zero.',
    'active_url'                     => 'The :attribute is not a valid URL.',
    'after'                          => 'The :attribute must be a date after :date.',
    'alpha'                          => 'The :attribute may only contain letters.',
    'alpha_dash'                     => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'                      => 'The :attribute may only contain letters and numbers.',
    'array'                          => 'The :attribute must be an array.',
    'unique_for_user'                => 'There already is an entry with this :attribute.',
    'before'                         => 'The :attribute must be a date before :date.',
    'unique_object_for_user'         => 'This name is already in use',
    'unique_account_for_user'        => 'This account name is already in use',
    'between.numeric'                => 'The :attribute must be between :min and :max.',
    'between.file'                   => 'The :attribute must be between :min and :max kilobytes.',
    'between.string'                 => 'The :attribute must be between :min and :max characters.',
    'between.array'                  => 'The :attribute must have between :min and :max items.',
    'boolean'                        => 'The :attribute field must be true or false.',
    'confirmed'                      => 'The :attribute confirmation does not match.',
    'date'                           => 'The :attribute is not a valid date.',
    'date_format'                    => 'The :attribute does not match the format :format.',
    'different'                      => 'The :attribute and :other must be different.',
    'digits'                         => 'The :attribute must be :digits digits.',
    'digits_between'                 => 'The :attribute must be between :min and :max digits.',
    'email'                          => 'The :attribute must be a valid email address.',
    'filled'                         => 'The :attribute field is required.',
    'exists'                         => 'The selected :attribute is invalid.',
    'image'                          => 'The :attribute must be an image.',
    'in'                             => 'The selected :attribute is invalid.',
    'integer'                        => 'The :attribute must be an integer.',
    'ip'                             => 'The :attribute must be a valid IP address.',
    'json'                           => 'The :attribute must be a valid JSON string.',
    'max.numeric'                    => 'The :attribute may not be greater than :max.',
    'max.file'                       => 'The :attribute may not be greater than :max kilobytes.',
    'max.string'                     => 'The :attribute may not be greater than :max characters.',
    'max.array'                      => 'The :attribute may not have more than :max items.',
    'mimes'                          => 'The :attribute must be a file of type: :values.',
    'min.numeric'                    => 'The :attribute must be at least :min.',
    'min.file'                       => 'The :attribute must be at least :min kilobytes.',
    'min.string'                     => 'The :attribute must be at least :min characters.',
    'min.array'                      => 'The :attribute must have at least :min items.',
    'not_in'                         => 'The selected :attribute is invalid.',
    'numeric'                        => 'The :attribute must be a number.',
    'regex'                          => 'The :attribute format is invalid.',
    'required'                       => 'The :attribute field is required.',
    'required_if'                    => 'The :attribute field is required when :other is :value.',
    'required_unless'                => 'The :attribute field is required unless :other is in :values.',
    'required_with'                  => 'The :attribute field is required when :values is present.',
    'required_with_all'              => 'The :attribute field is required when :values is present.',
    'required_without'               => 'The :attribute field is required when :values is not present.',
    'required_without_all'           => 'The :attribute field is required when none of :values are present.',
    'same'                           => 'The :attribute and :other must match.',
    'size.numeric'                   => 'The :attribute must be :size.',
    'size.file'                      => 'The :attribute must be :size kilobytes.',
    'size.string'                    => 'The :attribute must be :size characters.',
    'size.array'                     => 'The :attribute must contain :size items.',
    'unique'                         => 'The :attribute has already been taken.',
    'string'                         => 'The :attribute must be a string.',
    'url'                            => 'The :attribute format is invalid.',
    'timezone'                       => 'The :attribute must be a valid zone.',
    '2fa_code'                       => 'The :attribute field is invalid.',
    'dimensions'                     => 'The :attribute has invalid image dimensions.',
    'distinct'                       => 'The :attribute field has a duplicate value.',
    'file'                           => 'The :attribute must be a file.',
    'in_array'                       => 'The :attribute field does not exist in :other.',
    'present'                        => 'The :attribute field must be present.',
    'amount_zero'                    => 'The total amount cannot be zero',
    'secure_password'                => 'This is not a secure password. Please try again. For more information, visit https://goo.gl/NCh2tN',
];
