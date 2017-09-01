<template>
    <div>
        <div class="panel panel-primary" v-for="(question, index) in classTest.questions">
            <div class="panel-heading">
                <button class="btn btn-default btn-sm" @click="editQuestion(question)">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button class="btn btn-danger btn-sm" @click="deleteQuestion(index)">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                {{question.question}} - {{question.point}}
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="choice in question.choices">
                        {{choice.choice}}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            classTest(){
                return store.state.teacher.classTest.classTest;
            }
        },
        methods: {
            editQuestion(question) {
                return store.commit('teacher/classTest/setQuestion', question);
            },
            deleteQuestion(index) {
                return store.commit('teacher/classTest/deleteQuestion', index);
            }
        }
    }
</script>