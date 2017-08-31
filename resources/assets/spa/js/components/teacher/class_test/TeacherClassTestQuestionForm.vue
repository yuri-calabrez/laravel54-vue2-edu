<template>
    <form class="form-horizonal" @submit.prevent="addQuestion">
        <div class="form-group">
            <label for="question" class="control-label">Questão</label>
            <textarea id="question" name="question" class="form-control"
                      v-model="question.question"></textarea>
        </div>
        <div class="form-group">
            <label for="point" class="control-label">Pontos</label>
            <input name="point" id="point" class="form-control" v-model="question.point">
        </div>
        <button class="btn btn-success btn-block">Adicionar</button>
    </form>
</template>

<script type="text/javascript">
    import store from '../../../store/store';

    export default {
        computed: {
            question() {
               //return this.$deepModel('teacher.classTest.question');
               return store.state.teacher.classTest.question;
            }
        },
        methods: {
            addQuestion() {
                store.commit('teacher/classTest/addQuestion');
            }
        }
    }
</script>