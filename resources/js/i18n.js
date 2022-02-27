import ar from "./lang/ar"; // arabic
import en from "./lang/en"; // english
import de from "./lang/de"; // germany
import ru from "./lang/ru"; // rousi
import pl from "./lang/pl"; // Portuguese
import VueI18n from "vue-i18n";
import Vue from "vue";

Vue.use(VueI18n);

export default new VueI18n({
    locale: localStorage.getItem("lang") || "en",
    messages: {
        en: en,
        ar: ar,
        de: de,
        ru: ru,
        pl: pl
    }
});
