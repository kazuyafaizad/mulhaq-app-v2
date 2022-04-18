require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import Toaster from "@meforma/vue-toaster";
import VueSocialSharing from "vue-social-sharing";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const socialApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toaster)
            .use(VueSocialSharing)
            .mixin({ methods: { route } });

        socialApp.config.globalProperties.$echo = window.Echo;
        socialApp.mount(el);

        return socialApp;
    },
});

InertiaProgress.init({ color: "#4B5563" });
