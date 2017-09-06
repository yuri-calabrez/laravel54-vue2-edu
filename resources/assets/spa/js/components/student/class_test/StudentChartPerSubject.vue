<template>
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1 v-if="classInformation">Turma {{classInformation | classInformationAlias}}</h1>
			</div>
			<div id="chart"></div>
		</div>
	</div>
</template>

<script type="text/javascript">
	import scriptjs from 'scriptjs'; 
	import store from '../../../store/store';
	import classInformationMixin from '../../../mixins/classInformation.mixin';
	import {Student} from '../../../services/resources';

	export default {
		mixins: [classInformationMixin],
		data(){
			return {
				data: []
			}
		},
		computed: {
			storeType(){
				return 'student';
			}
		},
		mounted(){
			let classTeachingId = this.$route.params.class_teaching;
			let classInformationId = this.$route.params.class_information;
			store.dispatch('student/classInformation/get', classInformationId);
			store.dispatch('student/classTeaching/get', {classInformationId, classTeachingId})
			.then(this.getData)
			.then(data => {
				if(data.length === 1) {
					return;
				}
				this.data = data;
				this.initGoogleCharts();
			});
		},
		methods: {
			initGoogleCharts(){
				let self = this;
				scriptjs('https://www.gstatic.com/charts/loader.js', function(){
					google.charts.load('current', {'packages': ['corechart']});
					google.charts.setOnLoadCallback(self.drawChart);
				});
			},
			drawChart(){
				let options = {
					title: `Aproveitamento da disciplina ${this.classTeaching.subject.name}`,
					curveType: 'function'
				};

				let chart = new google.visualization.LineChart(document.getElementById('chart'));
				chart.draw(google.visualization.arrayToDataTable(this.data), options);
			},
			getData(){
				let data = [
				['Data de avaliação', 'Aproveitamento']
				];

				return Student.classTestResult.perSubject({class_teaching: this.classTeaching.id})
				.then(response => {
					for(let object of response.data) {
						object.created_at = this.$options.filters.dateBr(object.created_at);
						data.push(Object.values(object));
					}
					return data;
				});
			}
		}
	}
</script>