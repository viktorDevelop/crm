<!DOCTYPE html>
<html>
<head>
    <title>{{ title }}</title>
</head>
<body>
<h1>{{ title }}</h1>

{% if users %}
<ul>
    {% foreach users as user %}
    <li>{{ user.name }} ({{ user.age }} лет)</li>
    {% endforeach %}
</ul>
{% else %}
<p>Пользователи не найдены</p>
{% endif %}


</body>
</html>