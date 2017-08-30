<template>
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>Nova Avaliações de {{classInformationName}}</h1>
            </div>

            <form class="form-horizontal" @submit.prevent="save">
                <fieldset>
                    <legend>Informações da avaliação</legend>
                    <div class="col-md-6">
                        <label for="name" class="control-label">Nome</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="date_start" class="control-label">Início</label>
                        <input type="datetime-local" id="date_start" name="date_start" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="date_end" class="control-label">Fim</label>
                        <input type="datetime-local" id="date_end" name="date_end" class="form-control">
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
        cumputed:{
            classTests(){
                return store.state.teacher.classTest.classTests;
            }
        },
        mounted(){
            let classTeachingId = this.$route.params.class_teaching;
            store.dispatch('teacher/classTeaching/get', classTeachingId);
        }
    }
</script>