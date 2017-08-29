<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Avaliações de {{classInformationName}}</h1>
            </div>
        </div>
        <router-link :to="classTestCreateRoute" class="btn btn-primary">
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
                <td>{{classTest.point}}</td>
                <td>#</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    export default {
        computed: {
            classTests(){
                return store.state.teacher.classTest.classTests;
            }
        },
        mounted(){

        },
        methods: {

        }
    }
</script>