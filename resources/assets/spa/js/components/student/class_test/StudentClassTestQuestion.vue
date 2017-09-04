<template>
    <div class="row" v-if="question">
        <h3>Questão #{{questionIndex+1}}</h3>
        <div class="panel panel-primary">
            <div class="panel-heading">
                {{question.question}} - {{question.point}}
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <a href="#" @click.prevent="setChoice(choice)" v-for="(choice, index) in question.choices">
                        <li class="list-group-item" :class="activeChoice(choice)">
                            <span class="glyphicon glyphicon-ok" v-if="choice['true']"></span>
                            {{index+1}} - {{choice.choice}}
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            question() {
                return store.state.student.classTest.question;
            },
            questionIndex() {
                return store.state.student.classTest.questionIndex;
            },
            choices(){
                return store.state.student.studentClassTest.studentClassTest.choices;
            }
        },
        methods: {
            setChoice(choice) {
                store.commit('student/studentClassTest/setChoiceTrue', {
                    choiceId: choice.id,
                    question: this.question
                });
            },

            activeChoice(choice){
                return {
                    'active': this.choices[this.question.id] == choice.id
                }
            }
        }
    }
</script>