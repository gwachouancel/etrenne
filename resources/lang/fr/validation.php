<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted' => ':attribute doit être accepté.',
    'active_url' => ':attribute n\'est pas une URL valide.',
    'after' => ':attribute doit être une date supérieure à :date.',
    'after_or_equal' => ':attribute doit être une date supérieure ou égale à :date.',
    'alpha' => ':attribute devrait seulement contenir des lettres.',
    'alpha_dash' => ':attribute devrait seulement contenir des lettres, chiffres, tirets and underscores.',
    'alpha_num' => ':attribute devrait contenir selement des lettres et des chiffres.',
    'array' => ':attribute doit être un tableau.',
    'before' => ':attribute doit être une date avant :date.',
    'before_or_equal' => ':attribute doit être une date avant ou égale à :date.',
    'between' => [
        'numeric' => ':attribute doit être compris entre :min et :max.',
        'file' => ':attribute doit être compris entre :min et :max kilobytes.',
        'string' => ':attribute doit être compris entre :min and :max caractères.',
        'array' => ':attribute doit être compris entre :min and :max élements.',
    ],
    'boolean' => ':attribute doit avoir comme valeur booléenne Vrai ou Faux.',
    'confirmed' => 'Le champs de confirmation de :attribute ne corresponds pas.',
    'date' => ':attribute n\'est pas une date valide.',
    'date_equals' => ':attribute doit etre une date égale à :date.',
    'date_format' => ':attribute ne corresponds pas au format :format.',
    'different' => ':attribute et :other doivent être différent.',
    'digits' => ':attribute doit avoir :digits digits.',
    'digits_between' => ':attribute doit être compris entre :min et :max digits.',
    'dimensions' => ':attribute a des dimensiosn d\'image invalide.',
    'distinct' => ':attribute est une value dupliquée.',
    'email' => ':attribute doit être une adresse email valide.',
    'ends_with' => ':attribute doit se terminer avec un des élements suivants: :values.',
    'exists' => 'Cette valeur de :attribute est invalide.',
    'file' => ':attribute doit etre un fichier.',
    'filled' => ':attribute doit avoir une valeur.',
    'gt' => [
        'numeric' => ':attribute doit etre suppérieur à :value.',
        'file' => ':attribute doit etre suppérieur à :value kilobytes.',
        'string' => ':attribute doit etre suppérieur à :value caractères.',
        'array' => ':attribute doit avoir plus de :value élements.',
    ],
    'gte' => [
        'numeric' => ':attribute doit être supérieur ou égqle à :value.',
        'file' => ':attribute doit être supérieur ou égqle à :value kilobytes.',
        'string' => ':attribute doit être supérieur ou égqle à :value caratères.',
        'array' => ':attribute doit avoir :value élements ou plus.',
    ],
    'image' => ':attribute doit être une image.',
    'in' => 'La valeur sélectionné de :attribute est invalide.',
    'in_array' => ':attribute doit avoir une de ces valeurs :other.',
    //'in_array' => ':attribute doit exister dans :other.',
    'integer' => ':attribute doit être un entier.',
    'ip' => ':attribute doit etre une adresse IP valide.',
    'ipv4' => ':attribute doit etre une adresse IPv4 valide.',
    'ipv6' => ':attribute doit etre une adresse IPv6 valide.',
    'json' => ':attribute doit être un json valide.',
    'lt' => [
        'numeric' => ':attribute doit être inférieur à :value.',
        'file' => ':attribute doit être inférieur à :value kilobytes.',
        'string' => ':attribute doit être inférieur à :value caractères.',
        'array' => ':attribute doit avoir moins de :value élements.',
    ],
    'lte' => [
        'numeric' => ':attribute doit être inférieur ou égale à :value.',
        'file' => ':attribute doit être inférieur ou égale à :value kilobytes.',
        'string' => ':attribute doit être inférieur ou égale à :value caractères.',
        'array' => ':attribute de doit pas avoir plus de :value élements.',
    ],
    'max' => [
        'numeric' => ':attribute ne devrait pas dépasser :max.',
        'file' => ':attribute ne devrait pas dépasser :max kilobytes.',
        'string' => ':attribute ne devrait pas dépasser :max caractères.',
        'array' => ':attribute ne devrait pas avoir plus de :max élements.',
    ],
    'mimes' => ':attribute doit etre un fichier de type: :values.',
    'mimetypes' => ':attribute doit etre un fichier de type: :values.',
    'min' => [
        'numeric' => ':attribute devrait etre au moins :min.',
        'file' => ':attribute devrait etre au moins :min kilobytes.',
        'string' => ':attribute devrait etre au moins :min caractères.',
        'array' => ':attribute devrait avoir au moins :min élements.',
    ],
    'not_in' => 'La valeur sélectionée de :attribute est invalide.',
    'not_regex' => 'Le format de :attribute est invalide.',
    'numeric' => ':attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => ':attribute doit être présent.',
    'regex' => 'Le format de :attribute est invalide.',
    'required' => ':attribute est obliatoire.',
    'required_if' => ':attribute est obligatoire quand :other a comme valeur :value.',
    'required_unless' => ':attribute est obligatoire a moins que :other ait une de ces valeurs :values.',
    'required_with' => ':attribute est obligatoire quand :values  est présent.',
    'required_with_all' => ':attribute est obligaioire quand :values sont présent.',
    'required_without' => ':attribute est obligatoire quand :values n\'est pas présent.',
    'required_without_all' => ':attribute est obligatoire quand aucune ce ces valeurs :values n\'est présente.',
    'same' => ':attribute et :other doivent correspondre.',
    'size' => [
        'numeric' => ':attribute doit avoir :size.',
        'file' => ':attribute doit avoir :size kilobytes.',
        'string' => ':attribute doit avoir :size caractères.',
        'array' => ':attribute doit avoir :size élements.',
    ],
    'starts_with' => ':attribute doit débuter avec un des élements suivants: :values.',
    'string' => ':attribute doit être une chaine de caractères.',
    'timezone' => ':attribute doit etre une zone valide.',
    'unique' => 'Cette valeur de :attribute existe déjà.',
    'uploaded' => ':attribute n\'a pas pu être téléversé.',
    'url' => 'Le format de :attribute est invalide.',
    'uuid' => ':attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        [
            'firebase_id' => [
                'unique' => 'Cet Utilisateur existe déjà !',
                'exists' => 'Cet Uilisateur n\'existe pas !',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
