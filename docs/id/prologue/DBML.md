---
title: DBML
icon: heroicon-o-circle-stack
order: 2
---

## Output

![Output](https://i.ibb.co.com/v4KsKckW/dbml.png)

## DBML Code

```dbml
Table wifi {
    id int [primary key, increment]
    brand varchar(255)
    type varchar(255)
    serial_number varchar(255) [unique]
    mac_address varchar(255) [unique]
    ssid varchar(255)
    password varchar(255)
    user_router varchar(255) [not null, default: 'admin']
    password_router varchar(255) [not null, default: 'admin']
    description text [null]
    opd_id int [not null, ref: > OPD.id]
    bidang_id int [not null, ref: > Bidang.id]
    photos json [not null]
    created_at timestamp
    updated_at timestamp
}

Table OPD {
    id int [primary key, increment]
    name varchar(255) [unique]
    created_at timestamp
    updated_at timestamp
}

Table Bidang {
    id int [primary key, increment]
    opd_id int [not null, ref: > OPD.id]
    name varchar(255)
    created_at timestamp
    updated_at timestamp
}
```
