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

        'accepted' => 'Kolom :attribute harus diterima.',
        'accepted_if' => 'Kolom :attribute harus diterima jika :other adalah :value.',
        'active_url' => 'Kolom :attribute bukan URL yang valid.',
        'after' => 'Kolom :attribute harus berisi tanggal setelah :date.',
        'after_or_equal' => 'Kolom :attribute harus berisi tanggal setelah atau sama dengan :date.',
        'alpha' => 'Kolom :attribute hanya boleh berisi huruf.',
        'alpha_dash' => 'Kolom :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
        'alpha_num' => 'Kolom :attribute hanya boleh berisi huruf dan angka.',
        'array' => 'Kolom :attribute harus berupa array.',
        'ascii' => 'Kolom :attribute hanya boleh berisi karakter alfanumerik satu byte dan simbol.',
        'before' => 'Kolom :attribute harus berisi tanggal sebelum :date.',
        'before_or_equal' => 'Kolom :attribute harus berisi tanggal sebelum atau sama dengan :date.',
        'between' => [
            'array' => 'Kolom :attribute harus memiliki antara :min dan :max item.',
            'file' => 'Kolom :attribute harus memiliki ukuran antara :min dan :max kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai antara :min dan :max.',
            'string' => 'Kolom :attribute harus memiliki panjang antara :min dan :max karakter.',
        ],
        'boolean' => 'Kolom :attribute harus berisi nilai benar atau salah.',
        'confirmed' => 'Konfirmasi kolom :attribute tidak cocok.',
        'current_password' => 'Kata sandi tidak benar.',
        'date' => 'Kolom :attribute harus berisi tanggal yang valid.',
        'date_equals' => 'Kolom :attribute harus berisi tanggal yang sama dengan :date.',
        'date_format' => 'Kolom :attribute tidak cocok dengan format :format.',
        'decimal' => 'Kolom :attribute harus memiliki :decimal tempat desimal.',
        'declined' => 'Kolom :attribute harus ditolak.',
        'declined_if' => 'Kolom :attribute harus ditolak jika :other adalah :value.',
        'different' => 'Kolom :attribute dan :other harus berbeda.',
        'digits' => 'Kolom :attribute harus berisi :digits digit.',
        'digits_between' => 'Kolom :attribute harus memiliki panjang antara :min dan :max digit.',
        'dimensions' => 'Kolom :attribute memiliki dimensi gambar yang tidak valid.',
        'distinct' => 'Kolom :attribute memiliki nilai duplikat.',
        'doesnt_end_with' => 'Kolom :attribute tidak boleh diakhiri dengan salah satu dari berikut: :values.',
        'doesnt_start_with' => 'Kolom :attribute tidak boleh diawali dengan salah satu dari berikut: :values.',
        'email' => 'Kolom :attribute harus berisi alamat email yang valid.',
        'ends_with' => 'Kolom :attribute harus diakhiri dengan salah satu dari berikut: :values.',
        'enum' => 'Nilai yang dipilih untuk :attribute tidak valid.',
        'exists' => 'Nilai yang dipilih untuk :attribute tidak valid.',
        'file' => 'Kolom :attribute harus berupa file.',
        'filled' => 'Kolom :attribute harus diisi.',
        'gt' => [
            'array' => 'Kolom :attribute harus memiliki lebih dari :value item.',
            'file' => 'Kolom :attribute harus berukuran lebih besar dari :value kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai lebih besar dari :value.',
            'string' => 'Kolom :attribute harus memiliki panjang lebih besar dari :value karakter.',
        ],
        'gte' => [
            'array' => 'Kolom :attribute harus memiliki :value item atau lebih.',
            'file' => 'Kolom :attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai lebih besar dari atau sama dengan :value.',
            'string' => 'Kolom :attribute harus memiliki panjang lebih besar dari atau sama dengan :value karakter.',
        ],
        'image' => 'Kolom :attribute harus berupa gambar.',
        'in' => 'Nilai yang dipilih untuk :attribute tidak valid.',
        'in_array' => 'Kolom :attribute tidak ada dalam :other.',
        'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
        'ip' => 'Kolom :attribute harus berisi alamat IP yang valid.',
        'ipv4' => 'Kolom :attribute harus berisi alamat IPv4 yang valid.',
        'ipv6' => 'Kolom :attribute harus berisi alamat IPv6 yang valid.',
        'json' => 'Kolom :attribute harus berupa string JSON yang valid.',
        'lowercase' => 'Kolom :attribute harus berisi huruf kecil.',
        'lt' => [
            'array' => 'Kolom :attribute harus memiliki kurang dari :value item.',
            'file' => 'Kolom :attribute harus berukuran lebih kecil dari :value kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai lebih kecil dari :value.',
            'string' => 'Kolom :attribute harus memiliki panjang lebih kecil dari :value karakter.',
        ],
        'lte' => [
            'array' => 'Kolom :attribute tidak boleh memiliki lebih dari :value item.',
            'file' => 'Kolom :attribute harus berukuran lebih kecil dari atau sama dengan :value kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai lebih kecil dari atau sama dengan :value.',
            'string' => 'Kolom :attribute harus memiliki panjang lebih kecil dari atau sama dengan :value karakter.',
        ],
        'mac_address' => 'Kolom :attribute harus berisi alamat MAC yang valid.',
        'max' => [
            'array' => 'Kolom :attribute tidak boleh memiliki lebih dari :max item.',
            'file' => 'Kolom :attribute tidak boleh lebih besar dari :max kilobita.',
            'numeric' => 'Kolom :attribute tidak boleh lebih besar dari :max.',
            'string' => 'Kolom :attribute tidak boleh lebih besar dari :max karakter.',
        ],
        'max_digits' => 'Kolom :attribute tidak boleh memiliki lebih dari :max digit.',
        'mimes' => 'Kolom :attribute harus berupa file dengan tipe: :values.',
        'mimetypes' => 'Kolom :attribute harus berupa file dengan tipe: :values.',
        'min' => [
            'array' => 'Kolom :attribute harus memiliki setidaknya :min item.',
            'file' => 'Kolom :attribute harus memiliki ukuran setidaknya :min kilobita.',
            'numeric' => 'Kolom :attribute harus memiliki nilai setidaknya :min.',
            'string' => 'Kolom :attribute harus memiliki panjang setidaknya :min karakter.',
        ],
        'min_digits' => 'Kolom :attribute harus memiliki setidaknya :min digit.',
        'missing' => 'Kolom :attribute harus hilang.',
        'missing_if' => 'Kolom :attribute harus hilang jika :other adalah :value.',
        'missing_unless' => 'Kolom :attribute harus hilang kecuali jika :other adalah :value.',
        'missing_with' => 'Kolom :attribute harus hilang jika :values hadir.',
        'missing_with_all' => 'Kolom :attribute harus hilang jika :values hadir.',
        'multiple_of' => 'Kolom :attribute harus merupakan kelipatan dari :value.',
        'not_in' => 'Nilai yang dipilih untuk :attribute tidak valid.',
        'not_regex' => 'Format kolom :attribute tidak valid.',
        'numeric' => 'Kolom :attribute harus berupa angka.',
        'password' => [
            'letters' => 'Kolom :attribute harus mengandung setidaknya satu huruf.',
            'mixed' => 'Kolom :attribute harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
            'numbers' => 'Kolom :attribute harus mengandung setidaknya satu angka.',
            'symbols' => 'Kolom :attribute harus mengandung setidaknya satu simbol.',
            'uncompromised' => ':attribute yang diberikan muncul dalam kebocoran data. Harap pilih :attribute yang berbeda.',
        ],
        'present' => 'Kolom :attribute harus ada.',
        'prohibited' => 'Kolom :attribute dilarang.',
        'prohibited_if' => 'Kolom :attribute dilarang jika :other adalah :value.',
        'prohibited_unless' => 'Kolom :attribute dilarang kecuali jika :other ada dalam :values.',
        'prohibits' => 'Kolom :attribute melarang :other untuk ada.',
        'regex' => 'Format kolom :attribute tidak valid.',
        'required' => 'Kolom :attribute harus diisi.',
        'required_array_keys' => 'Kolom :attribute harus berisi entri untuk: :values.',
        'required_if' => 'Kolom :attribute diperlukan ketika :other adalah :value.',
        'required_if_accepted' => 'Kolom :attribute diperlukan ketika :other diterima.',
        'required_unless' => 'Kolom :attribute diperlukan kecuali jika :other ada dalam :values.',
        'required_with' => 'Kolom :attribute diperlukan ketika :values hadir.',
        'required_with_all' => 'Kolom :attribute diperlukan ketika :values hadir.',
        'required_without' => 'Kolom :attribute diperlukan ketika :values tidak hadir.',
        'required_without_all' => 'Kolom :attribute diperlukan ketika tidak ada satu pun dari :values yang hadir.',
        'same' => 'Kolom :attribute harus sama dengan :other.',
        'size' => [
            'array' => 'Kolom :attribute harus berisi :size item.',
            'file' => 'Kolom :attribute harus berukuran :size kilobita.',
            'numeric' => 'Kolom :attribute harus berukuran :size.',
            'string' => 'Kolom :attribute harus berukuran :size karakter.',
        ],
        'starts_with' => 'Kolom :attribute harus diawali dengan salah satu dari berikut: :values.',
        'string' => 'Kolom :attribute harus berupa string.',
        'timezone' => 'Kolom :attribute harus berisi zona waktu yang valid.',
        'unique' => 'Kolom :attribute sudah ada.',
        'uploaded' => 'Kolom :attribute gagal diunggah.',
        'uppercase' => 'Kolom :attribute harus berisi huruf kapital.',
        'url' => 'Format kolom :attribute tidak valid.',
        'ulid' => 'Kolom :attribute harus berupa ULID yang valid.',
        'uuid' => 'Kolom :attribute harus berupa UUID yang valid.',

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
