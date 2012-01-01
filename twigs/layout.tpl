{% import "head.tpl" as head %}
<html>
<head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
{% block head %}
{{ head.jquery() }}
<script type="text/javascript">
	var URL_PATH = '{{ URL_PATH }}';
	var MEDIA_PATH = '{{ MEDIA_PATH }}';
	var TEMPLATE_PATH = '{{ TEMPLATE_PATH }}';
</script>
<link rel="stylesheet" href="{{ MEDIA_PATH }}/styles/standard.css" />
<title>Laser protection</title>
{% endblock %}
</head>
<body>
<table>
<tr><td valign="top">
{% block menu %}

{% endblock %}
</td><td valign="top">
	{% block content %}
	{% endblock %}
</td></tr>
</table>
</body>
</html>