import ar from "./lang/ar";
import en from "./lang/en";
import VueI18n from "vue-i18n";
import Vue from "vue";

Vue.use(VueI18n);

export default new VueI18n({
    locale: localStorage.getItem("lang") || "en",
    messages: {
        en: en,
        ar: ar
    }
});
