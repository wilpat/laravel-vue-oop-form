class Errors{

	constructor(){
		this.errors = {}
	}

	get(field) {
		if(this.errors[field]){
			return this.errors[field][0];
		}
	}

	record(errors){
		return this.errors = errors;
	}

	clear(field){
		if(field) {
			delete this.errors[field];
			return
		}
		
		this.errors = {}
	}

	has(field){
		return this.errors.hasOwnProperty(field);
	}

	any(){
		return Object.keys(this.errors).length > 0;
	}

}

class Form{

	constructor(data){
		this.originalData = data;

		for (let field in data){
			this[field] = data[field];
		}

		this.errors = new Errors();
	}

	data(){
		let data = {};

		for (let field in this.originalData){
			data[field] = this[field];
		}

		return data;
	}

	reset(){
		for (let field in this.originalData){
			this[field] = '';
		}
	}

	submit(requestType, url){
		return new Promise((resolve, reject) =>{
			axios[requestType](url, this.data())
				.then(response => {
					this.onSuccess(response.data.message);
					resolve(response.data.message);
				})
				.catch(error =>{
					this.onFail(error.response.data.errors)
					reject(error.response.data.errors)
				});
		})
		
	}

	onSuccess(message) {
		this.errors.clear();

		this.reset();
	}

	onFail(errors){
		this.errors.record(errors)
	}
}

new Vue({
	el: '#app',

	data:{
		form: new Form({
			name: '',
			description: ''
		}),
	},

	methods: {
		onSubmit(){
			this.form.submit('post', '/projects')
				.then(alert)
				.catch(console.log)
		}
	}
});