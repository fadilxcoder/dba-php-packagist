Fake InMemoryDatabase - PHP DBA Cache
=======================================

- SF6 - `var/storage/app.db4`

- Usage :
```php
...
    $faker = Faker::create();
    $db = new InMemoryDatabase();
    $cache = $db->initialize();

    foreach (range(1, 5) as $value) {
        $uuid  = $faker->uuid();
        # Insert values into cache
        $cache->put(
            $uuid, 
            [
                'idx' => $value,
                'uuid' => $uuid,
                'fullname' =>  $faker->name(),
                'email' => $faker->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'job' => $faker->jobTitle(),
                'credit_card' => $faker->creditCardType(),
                'credit_card_number' => $faker->creditCardNumber(),
                'iban' => $faker->iban(),
            ]
        );
        $output->writeln([
            'Account UUID ' . $uuid . '✅'
        ]);
    }

    # Update values into cache
    $content = $cache->get($uuid);
    $newArr = [
        'country_code' => $faker->countryCode(),
        'currency_code' => $faker->currencyCode(),
    ];
    $cache->put($uuid, array_merge($content, $newArr));

    dump(
        $uuid,
        $content,
        $cache->has($uuid),
        $cache->get($uuid),
        $cache->delete($uuid),
        $cache->get($uuid)
    );

    # Remove cache file
    $db->truncate();
...

```

```bash
/var/www/html # php bin/console dba:cache:init

Account UUID 414dcab8-799c-36ed-95c8-bceceaefa035✅
Account UUID 63353b8d-2867-37d1-bbf4-407d28837584✅
Account UUID d51007d9-740a-31b4-9342-4589d08b1402✅
Account UUID e835c52c-5a9f-3c60-b0c5-cf4c3d96fe14✅
Account UUID 35ae48d8-c3fb-3462-99f9-df7cbe0bb872✅

^ "35ae48d8-c3fb-3462-99f9-df7cbe0bb872"

^ array:9 [
  "idx" => 5
  "uuid" => "35ae48d8-c3fb-3462-99f9-df7cbe0bb872"
  "fullname" => "Adella Wisozk"
  "email" => "qadams@example.net"
  "phone" => "1-254-667-9320"
  "job" => "Probation Officers and Correctional Treatment Specialist"
  "credit_card" => "Discover Card"
  "credit_card_number" => "5516717022368992"
  "iban" => "AL2184335126V2D02L4B6P9740A2"
]

^ true

^ array:11 [
  "idx" => 5
  "uuid" => "35ae48d8-c3fb-3462-99f9-df7cbe0bb872"
  "fullname" => "Adella Wisozk"
  "email" => "qadams@example.net"
  "phone" => "1-254-667-9320"
  "job" => "Probation Officers and Correctional Treatment Specialist"
  "credit_card" => "Discover Card"
  "credit_card_number" => "5516717022368992"
  "iban" => "AL2184335126V2D02L4B6P9740A2"
  "country_code" => "ES"
  "currency_code" => "ZMW"
]

^ true

^ false

```

[Click for more information.](https://github.com/gjerokrsteski/php-dba-cache.git)

