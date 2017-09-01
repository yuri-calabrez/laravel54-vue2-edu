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
                <th>Editar</th>
                <th>Remover</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="classTest in classTests">
                <td>{{classTest.name}}</td>
                <td>{{classTest.date_start}}</td>
                <td>{{classTest.date_end}}</td>
                <td>{{classTest.total_questions}}</td>
                <td>{{classTest.total_points}}</td>
                <td>
                    <router-link :to="routeClassTestEdit(classTest.id)" class="btn btn-primary">
                        Editar Avaliação
                    </router-link>
                </td>
                <td>
                    <a href="#" class="btn btn-danger" @click.prevent="deleteQuestion(classTest)">
                        Remover
                    </a>
                </td>
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
            classTests() {
                return store.state.teacher.classTest.classTests;
            },
            routeClassTestCreate() {
                return {
                    name: 'teacher.class_tests.create_data',
                    params: {
                        'class_teaching': this.$route.params.class_teaching
                    }
                }
            }
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get', classTeachingId);
            store.dispatch('teacher/classTest/query', classTeachingId);
        },
        methods: {
            routeClassTestEdit(classTestId) {
                return {
                    name: 'teacher.class_tests.update_data',
                    params: {
                        class_teaching: this.$route.params.class_teaching,
                        class_test: classTestId
                    }
                }
            },
            deleteQuestion(classTest) {
                if (confirm("Deseja realmente excluir?")) {
                    store.dispatch('teacher/classTest/delete', {
                        classTeachingId: this.$route.params.class_teaching,
                        classTestId: classTest.id
                    });
                }

            }
        }
    }
</script>