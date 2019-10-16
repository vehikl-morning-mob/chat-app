<template>
    <div>
        This is the Landing Page
        <register-form></register-form>
        <message-form></message-form>
    </div>
</template>

<script lang="ts">
    import {Component, Vue} from "vue-property-decorator"
    import RegisterForm from "../components/RegisterForm.vue";
    import MessageForm from "../components/MessageForm.vue";

    @Component({
        components: {MessageForm, RegisterForm}
    })
    export default class LandingPage extends Vue {
    };
</script>
