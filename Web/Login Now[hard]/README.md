# Login Now

**Сложность:** hard

## Описание

Пожалуйста, проверьте функцию входа в систему, в ней могут быть серьёзные уязвимости. FLAG хранится в /flagXXX.txt, найдите способ прочитать его.

```sh
FLAG=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 5 | head -n 1)
cp /flag.txt /flag$FLAG.txt
```

**Автор:** Cookie Han Hoan - @shanglyu<br>
**Ссылка:** ip:1340
**Флаг:** `flag{base_64_md5_expl@it_1337}`<br>
**Файлы:**

## Writeup
Link: https://www.mscs.dal.ca/~selinger/md5collision/  https://github.com/phith0n/collision-webshell
