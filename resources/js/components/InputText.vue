<script>
export default {
    name: "InputText",
    props: {
        label: String,
        name: String,
        id: String,
        placeholder: String,
        modelValue: {
            default: "",
            type: String,
        },
        disabled: {
            default: false,
            type: Boolean,
        },
        error: {
            default: "",
            type: String,
        },
    },
};
</script>

<template>
    <div class="input-text-container">
        <label :for="id" class="input-text-label">{{ label }}</label>
        <input
            type="text"
            class="input-text"
            :name="name"
            :id="id"
            :placeholder="placeholder"
            :disabled="disabled"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <Transition>
            <span v-if="error" class="input-text-error">{{ error }}</span>
        </Transition>
    </div>
</template>

<style scoped>
.input-text-container {
    width: inherit;
    display: flex;
    flex-direction: column;
    gap: 12px;

    .input-text-label {
        font-size: 0.95rem;
        text-shadow: 2.5px 2.5px var(--text-shadow-color);
    }

    .input-text {
        height: 3rem;
        padding-inline: 11px;
        color: var(--secondary-color);
        border: none;
        outline: none;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: all 300ms ease;
        opacity: 0.7;

        &:hover,
        &:focus {
            opacity: 1;
        }
    }

    .input-text-error {
        color: var(--error-color);
        text-shadow: 2px 2px var(--text-shadow-color);
    }
}
</style>
