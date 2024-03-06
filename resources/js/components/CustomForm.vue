<script>
import InputText from "./InputText.vue";
import InputCheckbox from "./InputCheckbox.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
    name: "CustomForm",
    components: {
        InputText,
        InputCheckbox,
    },
    setup() {
        const showFolderNameInput = ref(false);

        const shortUrlForm = useForm({
            url: null,
            folder: null,
        });

        const toggleShowFolderNameInput = () => {
            showFolderNameInput.value = !showFolderNameInput.value;
        };

        const postGenerateShortUrl = () => {
            if (!showFolderNameInput.value) {
                shortUrlForm.folder = null;
            }

            shortUrlForm.post(route("generateShortUrl"), {
                onSuccess: () => {
                    shortUrlForm.reset("url", "folder");

                    const { success, throwable } = usePage().props.flash;
                    success ? console.info(success) : console.error(throwable);
                },
            });
        };

        return {
            showFolderNameInput,
            shortUrlForm,
            toggleShowFolderNameInput,
            postGenerateShortUrl,
        };
    },
};
</script>

<template>
    <form @submit.prevent="postGenerateShortUrl" class="section-form">
        <InputText
            label="Enter your url:"
            name="url"
            id="url"
            placeholder="https://www.google.com"
            v-model="shortUrlForm.url"
            :error="shortUrlForm.errors.url"
        />
        <InputCheckbox
            label="Add folder"
            name="add-folder"
            id="add-folder"
            @checkboxClicked="toggleShowFolderNameInput"
        />
        <Transition>
            <InputText
                v-if="showFolderNameInput"
                label="Enter your folder name:"
                name="folder"
                id="folder"
                placeholder="(Valid symbols: A-Z, a-z, 0-9, -, _)"
                v-model="shortUrlForm.folder"
                :error="shortUrlForm.errors.folder"
            />
        </Transition>
        <div class="section-form-submit-button-container">
            <button class="button"> Submit </button>
        </div>
    </form>
</template>

<style scoped>
.section-form {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 25px;

    .section-form-submit-button-container {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-top: 20px;
        color: black;
    }
    .button {
        background-color: #04AA6D;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }



}
</style>
