####Приклад запиту для додавання нового користувача:

`$ http://basic/twitter/add?id=bc0d9f843dc649219f43eb229f8ef6a0&secret=60accb329ce053ef6b211d4989647b06d35b5bd8&username=elonmusk`

#####Опис параметрів:

Параметр  | Опис
------------- | -------------
id  | Унікальний ідентифікатор запиту
username  | Користувач твітера
secret  | Секретний параметр

---

####Приклад запиту для додавання нового користувача:

`$ http://basic/twitter/feed?id=11430fe6885842cea5b15b373705904a&secret=6a68b066594dfd47d5ce7ba6fd5f01f42c530d80`

#####Опис параметрів:

Параметр  | Опис
------------- | -------------
id  | Унікальний ідентифікатор запиту
secret  | Секретний параметр

#####Відповідь від серверу:

```json
{
    "feed": [
        {
            "user": "zelenskyyua",
            "tweet": "НАШІ ВДОМА!",
            "hashtag": []
        },
        {
            "user": "idontseesea",
            "tweet": "RT @jimmyfallon: .@postmalone and I go to Medieval Times https://t.co/uzW7rqwh35 #SundayNightFallon",
            "hashtag": [
                "SundayNightFallon"
            ]
        },
        {
            "user": "ildi_art",
            "tweet": "@riasaur You draw him so well aaaaaa!!!",
            "hashtag": []
        }
    ]
}

```

---

####Приклад запиту для видалення користувача:

`$ http://basic/twitter/remove?id=22e0d96d16a24d78976a283032cad59f&secret=7b98bf73948bdb78e9998e2ba0b7dc8c7641d0c5&username=elonmusk`

#####Опис параметрів:

Параметр  | Опис
------------- | -------------
id  | Унікальний ідентифікатор запиту
username  | Користувач твітера
secret  | Секретний параметр

