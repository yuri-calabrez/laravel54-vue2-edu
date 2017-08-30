<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Avaliações de {{classInformationName}}</h1>
            </div>
        </div>
        <router-link :to="routeClassTestCreate" class="btn btn-primary">
            Nova Avaliação
        </router-link>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Início</th>
                <th>Fim</th>
                <th>Questões</th>
                <th>Pontos</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="classTest in classTests">
                <td>{{classTest.name}}</td>
                <td>{{classTest.date_start}}</td>
                <td>{{classTest.date_end}}</td>
                <td>{{classTest.total_questions}}</td>
                <td>{{classTest.total_points}}</td>
                <td>#</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/classInformation.mixin';
    export default {
        mixins: [classInformationMixin],
        computed: {
            classTests(){
                return store.state.teacher.classTest.classTests;
            },
            routeClassTestCreate(){
                return {
                    name: 'class_tests.create_data',
                    params: {
                        'class_teaching': this.$route.params.class_teaching
                    }
                }
            }
        },
        mounted(){
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get', classTeachingId);
            store.dispatch('teacher/classTest/query', classTeachingId);
        },
        methods: {

        }
    }
</script>