<script>
export default {
    name: "UrlShortenerResult",
    data() {
        return {
            shortUrlCopied: false,
            interval: null,
        };
    },
    methods: {
        copyShortUrl() {
            const shortUrl = this.$refs.shortUrl;

            shortUrl.select();
            document.execCommand("copy");
            shortUrl.selectionStart = shortUrl.selectionEnd;
            this.shortUrlCopied = !this.shortUrlCopied;

            this.interval = setTimeout(() => {
                this.shortUrlCopied = !this.shortUrlCopied;
            }, 3 * 1000);
        },
    },
};
</script>

<template>
    <div class="section-result">
        <div class="section-result-full-input-button-container">
            <label for="short_url" class="section-result-label">
                Your generated short url:
            </label>
            <div class="section-result-input-button-container">
                <input
                    type="text"
                    class="section-result-input"
                    name="short_url"
                    id="short_url"
                    placeholder="https://example.com/folder/[hash]"
                    :value="$page.props.shortUrl"
                    ref="shortUrl"
                    readonly
                />
                <button
                    type="button"
                    class="section-result-copy-button"
                    :disabled="shortUrlCopied"
                    @click="copyShortUrl"
                >
                    <font-awesome-icon
                        v-if="shortUrlCopied"
                        icon="fa-solid fa-clipboard-check"
                        class="button-icon"
                    />
                    <span v-if="shortUrlCopied">Copied</span>
                    <span v-else>Copy</span>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.section-result {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 25px;

    .section-result-full-input-button-container {
        display: flex;
        flex-direction: column;
        gap: 12px;

        .section-result-label {
            font-size: 0.95rem;;
        }

        .section-result-input-button-container {
            display: flex;
            align-items: center;

            .section-result-input {
                height: 2.7rem;
                padding-inline: 12px;
                background-color: var(--input-background-color);
                color: var(--secondary-color);
                border: none;
                outline: none;
                box-shadow: 4px 4px var(--box-shadow-color);
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                transition: all 300ms ease;
                opacity: 0.7;
                width: 100%;

                &:hover,
                &:focus {
                    opacity: 1;
                }
            }

            .section-result-copy-button {
                height: 2.7rem;
                padding-inline: 20px;
                background-color: gray;
                border: none;
                box-shadow: 4px 4px var(--box-shadow-color);
                outline: none;
                transition: all 300ms ease;
                opacity: 0.8;
                min-width: 135px;
                border-left: 3px solid var(--box-shadow-color);
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;

                &:hover,
                &:focus {
                    opacity: 1;
                }

                &:disabled {
                    opacity: 0.5;
                }

                span {
                    color: var(--secondary-color);
                    font-size: 1rem;
                    font-weight: 600;
                }

                .button-icon {
                    font-size: 1.1rem;
                    filter: invert(100%) saturate(0%);
                }
            }
        }
    }
}
</style>
