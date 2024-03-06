<script>
import AppLayout from "../layouts/AppLayout.vue";
import CustomForm from "../components/CustomForm.vue";
import CustomResultBox from "../components/CustomResultBox.vue";

export default {
    name: "UrlShortener",
    components: {
        AppLayout,
        CustomForm,
        CustomResultBox,
    },
};
</script>

<template>
    <AppLayout>
        <h1 class="title">
            URL Shortener</h1>
        <section class="section">
            <CustomForm />
        </section>
        <Transition>
            <section v-if="$page.props.shortUrl" class="section">
                <CustomResultBox />
            </section>
        </Transition>
    </AppLayout>
</template>

<style scoped>
.title {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    font-size: 3rem;
}

.section {
    width: clamp(300px, 60vw, 600px);
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: rgb(65, 97, 87);
    padding: 2rem 2.5rem;
}
</style>../components/CustomResultBox.vue
