<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="page-header">
                    <h3>
                        Avaliação de<br/>
                        <small>
                            <strong>Turma: {{classInformationName}}</strong>
                        </small>
                        <br/>
                        <small>
                            <strong>Pontos: {{classTestPoints}}</strong>
                        </small>
                        <br/>
                        <small>
                            <strong>Início: {{classTestDateStart}}</strong>
                        </small>
                        <br/>
                        <small>
                            <strong>Fim:{{classTestDateEnd}}</strong>
                        </small>
                        <br/>
                    </h3>
                </div>

                <button class="btn btn-success btn-block" @click="save">Salvar</button>
            </div>
            <div class="col-md-9" v-if="classTest">
                <ol class="nav nav-pills">
                    <li v-for="(question, index) in classTest.questions">
                        <a href="#" @click.prevent="setQuestion(question)">
                            <span class="label" :class="defineColorQuestion(question)">#Questão {{index+1}}</span>
                        </a>
                    </li>
                </ol>
            </div>
        </div>

        <student-class-test-question></student-class-test-question>
    </div>
</template>
<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/classInformation.mixin';

    export default {
        mixins: [classInformationMixin],
        components: {
            'student-class-test-question': require('./StudentClassTestQuestion.vue')
        },
        computed: {
            storeType(){
                return 'student';
            },
            classTest(){
                return store.state.student.classTest.classTest;
            },
            classTestPoints(){
                let classTest = this.classTest;
                return classTest ? classTest.total_points : 0;
            },
            classTestDateStart(){
                let classTest = this.classTest;
                return classTest ? this.$options.filters.dateTimeBr(classTest.date_start) : '';
            },
            classTestDateEnd(){
                let classTest = this.classTest;
                return classTest ? this.$options.filters.dateTimeBr(classTest.date_end) : '';
            },
            choices(){
                return store.state.student.studentClassTest.studentClassTest.choices;
            }
        },
        mounted() {
            let classTeachingId = this.$route.params.class_teaching;
            let classInformationId = this.$route.params.class_information;
            let classTestId = this.$route.params.class_test;

            store.dispatch('student/classTeaching/get', {classInformationId, classTeachingId});
            store.dispatch('student/classTest/get', {classTeachingId, classTestId})
                .then(() => {
                    let question = this.classTest.questions[0];
                    store.commit('student/classTest/setQuestion', question);
                });
        },
        methods: {
            setQuestion(question){
                return store.commit('student/classTest/setQuestion', question);
            },
            defineColorQuestion(question) {
                return {
                    'label-default': !this.choices.hasOwnProperty(question.id),
                    'label-primary': this.choices.hasOwnProperty(question.id),
                }
            },
            save(){

            }
        }
    }
</script>

<style type="text/css" scoped>
    .nav > li > a {
        padding: 0px;
    }

    .page-header {
        margin-top: 0;
    }
</style>