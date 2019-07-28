<!DOCTYPE html>
<html>
<head>
	<title>OOP Forms</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css" />
	<style>
		body{
			padding-top: 40px;
		}
	</style>

</head>
<body>
	<div id="app" class="container">
		@include('projects.list')

		<form action="/projects" method="POST" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
			@csrf
			<div class="control">
				<label for="name" class="label"> Project Name</label>

				<input type="text" name="name" class="input" v-model="form.name">

				<span class="help is-danger" v-text="form.errors.get('name')" v-if="form.errors.has('name')"></span>
			</div>

			<div class="control">
				<label for="description" class="label"> Project description</label>
				<input type="text" name="description" class="input" v-model="form.description">
				<span class="help is-danger" v-text="form.errors.get('description')" v-if="form.errors.has('description')"></span>
			</div>

			<div class="control">
				<button class="button is-primary" :disabled="form.errors.any()">Create</button>
			</div>
		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
	<script src="https://unpkg.com/vue@2.1.6/dist/vue.js"></script>
	<script src="/js/app.js"></script>

</body>
</html>