<template>
	<form @submit.prevent="upload" action="/upload" method="post" enctype="multipart/form-data">

		<div v-if="alert.message" :class="['alert', 'alert-' + alert.type]">
			<strong v-if="alert.title">{{ alert.title }}</strong>
			<p>{{ alert.message }}</p>
		</div>

		<p>Max file size allowed is {{ dropzone.maxOriginalSize }} kb.</p>
		<dropzone 
			id="dropzone" 
			url="/upload" 
			v-on:vdropzone-success="uploaded"
			v-on:vdropzone-removed-file="removed"
			ref="dropzone"
			:maxNumberOfFiles="dropzone.maxFile"
			:autoProcessQueue="dropzone.autoQueue"
			:useFontAwesome="dropzone.fontAwesome">
			<input type="hidden" name="_token" :value="token">
		</dropzone>

		<div :class="['form-group', { 'has-error' : errors.label }]">
			<label class="checkbox-inline">
				<input v-model="state.private" type="checkbox" value="1">
				Make file is private
			</label>
		</div>

		<div :class="['form-group', { 'has-error' : errors.label }]">
			<label class="control-label" for="label">File Label</label>
			<input v-model="state.label" type="text" class="form-control">
			<span v-if="errors.label" class="help-block">{{ errors.label[0] }}</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.password }]">
			<label class="control-label" for="password">
				Password
				<small>
					<a href="#" class="text-info" data-toggle="popover" data-content="Protect you file with password">
						<i class="fa fa-info-circle fa-fw"></i>
					</a>
				</small>
			</label>
			<input v-model="state.password" type="password" class="form-control">
			<span v-if="errors.password" class="help-block">{{ errors.password[0] }}</span>
		</div>

		<div :class="['form-group', { 'has-error' : errors.expiration }]">
			<label class="control-label" for="expiration">File Expiration</label>
			<select v-model="state.expiration" class="form-control">
				<option v-for="(expiration, day) in expirations" :value="day">{{ expiration }}</option>
			</select>
			<span v-if="errors.expiration" class="help-block">{{ errors.expiration[0] }}</span>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary" :disabled="loading">
				Start Upload
				<i v-if="loading" class="fa fa-spin fa-spinner"></i>
			</button>
		</div>

		<p class="rule">By upload file, you agree with <a href="/rules" target="_blank">terms and conditions <i class="fa fa-external-link fa-fw"></i>.</a></p>
	</form>
</template>

<script>
	import Dropzone from 'vue2-dropzone';

	export default {
		name: 'UploadForm',

		components: {
			Dropzone
		},

		data() {
			return {
				alert: {},
				token: '',
				file: [],
				dropzone: {
					maxOriginalSize: 0,
					maxFileSize: 0,
					fontAwesome: true,
					autoQueue: false,
					maxFile: 1
				},	
				loading: false,
				errors: [],
				expirations: [],
				state: {
					uuid: '',
					label: '',
					private: false,
					expiration: 0
				}
			}
		},

		mounted() {
			// get max file size
			axios.post('/upload/size').then(response => {
				this.$refs.dropzone.setOption('maxFilesize', response.data.size);
				this.dropzone.maxOriginalSize = response.data.originalSize;
			}).catch(e => console.error(e));

			// get token
			axios.post('/app/token').then(response => {
				this.token = response.data.token;
			}).catch(e => console.error(e));

			// get expirarion options
			axios.post('/upload/expiration').then(response => {
				this.expirations = response.data;
			}).catch(e => console.error(e));
		},

		methods: {
			removed(file) {
				console.log(file);
			},

			upload() {
				this.$refs.dropzone.processQueue();
			},

			uploaded(file, response) {
				if (file.status != 'success') {
					this.alert = {
						type: 'danger',
						title: 'Error',
						message: 'Failed to upload file "' + file.name +'" due internal server error.'
					}
				}
				else {
					this.loading = true;
					if (this.state.label == '') {
						this.state.label = file.name;
					}

					this.state.uuid = response.uuid;

					axios.post('/upload/save', this.state).then(response => {
						if (response.data.status) {
							window.location = response.data.url;
						}
					});
				}
			},
		}
	}
</script>

<style scoped>
	#dropzone {
		margin-bottom: 20px;
	}

	.rule {
		margin-bottom: 20px;
	}
</style>