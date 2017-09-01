<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Nova Avaliações de {{classInformationName}}</h1>
            </div>

            <form class="form-horizontal" @submit.prevent="goToQuestions">
                <fieldset>
                    <legend>Informações da avaliação</legend>
                    <div class="col-md-6">
                        <label for="name" class="control-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" v-model="classTest.name">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="date_start" class="control-label">Início</label>
                        <input type="datetime-local" id="date_start" name="date_start" class="form-control"
                        v-model="classTest.date_start">
                    </div>

                    <div class="col-md-3">
                        <label for="date_end" class="control-label">Fim</label>
                        <input type="datetime-local" id="date_end" name="date_end" class="form-control"
                        v-model="classTest.date_end">
                    </div>

                    <div class="col-md-12" style="margin-top: 15px;">
                        <button class="btn btn-primary btn-block">Ir para as questões</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/classInformation.mixin';
    export default {
        mixins: [classInformationMixin],
        computed: {
            classTest(){
                return store.state.teacher.classTest.classTest;
                //return this.$deepModel('teacher.classTest.classTest');
            }
        },
        mounted(){
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get', classTeachingId);
            if(this.$route.name == 'teacher.class_tests.update_data') {
                store.dispatch('teacher/classTest/get', {
                    classTeachingId: classTeachingId,
                    classTestId: this.$route.params.class_test
                });
            }
        },
        methods: {
            goToQuestions(){
                this.$router.push({
                    name: 'teacher.class_tests.questions',
                    params: {
                        class_teaching: this.$route.params.class_teaching,
                        class_test: this.$route.params.class_test
                    }
                })
            }
        }
    }
</script>