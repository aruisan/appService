<form action="{{ route('demo.store') }}" method="POST">
	@csrf
	<input type="submit" value="Enviar">
</form>