<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Nova Avaliações de {{classInformationName}}</h1>
            </div>

            <div class="well well-sm">
                {{classTest.name}} | {{classTest.date_start}} à {{classTest.date_end}}
            </div>

            <div class="col-md-6">
                <teacher-class-test-question-form></teacher-class-test-question-form>
            </div>
            <div class="col-md-6">
                <teacher-class-test-question-list></teacher-class-test-question-list>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';
    import classInformationMixin from '../../../mixins/classInformation.mixin';
    export default {
        components: {
            'teacher-class-test-question-form': require('./TeacherClassTestQuestionForm.vue'),
            'teacher-class-test-question-list': require('./TeacherClassTestQuestionList.vue'),
        },
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
        }
    }
</script>