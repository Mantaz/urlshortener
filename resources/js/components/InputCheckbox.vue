<script>
export default {
    name: "InputCheckbox",
    props: {
        label: String,
        name: String,
        id: String,
    },
};
</script>

<template>
    <div class="input-checkbox-container">
        <label :for="id" class="input-checkbox-label">
            <input
                type="checkbox"
                class="input-checkbox"
                :name="name"
                :id="id"
                @click="$emit('checkboxClicked')"
            />
            <span class="input-checkbox-check-icon">&#10003;</span>
            {{ label }}
        </label>
    </div>
</template>

<style scoped>
.input-checkbox-container {
    width: inherit;
    display: flex;
    flex-direction: column;
    gap: 12px;

    .input-checkbox-label {
        display: flex;
        align-items: center;
        gap: 12px;
        position: relative;
        cursor: pointer;
        position: relative;

        &::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 30px;
            width: 91px;
            height: 2px;
            background-color: var(--primary-color);
        }

        .input-checkbox {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            background-color: var(--input-background-color);
            box-shadow: 4px 4px var(--box-shadow-color);
            border: none;
            border-radius: 0;
            outline: none;
            transition: all 300ms ease;
            opacity: 0.7;

            &:hover,
            &:focus {
                opacity: 1;
            }

            &:checked ~ .input-checkbox-check-icon {
                opacity: 1;
            }
        }

        .input-checkbox-check-icon {
            opacity: 0;
            position: absolute;
            top: -9px;
            left: 1px;
            font-size: 1.7rem;
            transition: opacity 50ms linear;
            color: var(--secondary-color);
            text-shadow: none;
        }
    }
}
</style>
