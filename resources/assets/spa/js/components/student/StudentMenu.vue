<template src="../templates/menu.html"></template>

<script type="text/javascript">
    import menuMixin from '../../mixins/menu.mixin';
    export default {
       mixins: [menuMixin],
        data(){
            return {
                menus: [
                    {name: "Minhas", routeName: 'teacher.class_teachings.list'}
                ],
                brandRouteName: 'teacher.class_teachings.list'
            }
        }
    }
</script>