<template>
    <LoadingComponent :props="loading" />

    <header class=" ff-header">
        <div class="container flex flex-col lg:flex-row items-center justify-between">
            <div class="w-full flex items-center justify-between gap-3 xl:gap-8 lg:justify-start lg:w-fit">
                <router-link :to="{ name: 'table.menu.table', params: { slug: this.$route.params.slug } }"
                    class="flex-shrink-0">
                    <img class="w-28 sm:w-40" :src="setting.theme_logo" alt="logo">
                </router-link>

                <!-- This code for mobile device -->
                <div class="flex items-center gap-2 lg:hidden">
                    <div v-if="setting.site_language_switch === enums.activityEnum.ENABLE"
                        class="block relative dropdown-group w-full sm:w-fit">
                        <button
                            class="flex items-center justify-center gap-1.5 w-fit rounded-3xl capitalize text-sm font-medium h-8 px-2.5 border transition text-heading bg-white border-gray-200 dropdown-btn">
                            <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                            <span class="whitespace-nowrap text-sm">{{ language.name }}</span>
                        </button>
                        <ul v-if="languages.length > 0"
                            class="p-2 min-w-[180px] rounded-lg shadow-xl absolute top-14 right-0 z-10 border border-gray-200 bg-white hidden dropdown-list">
                            <li @click="changeLanguage(language.id, language.code)" v-for="language in languages"
                                class="flex items-center gap-2 py-1.5 px-2.5 rounded-md cursor-pointer hover:bg-gray-100">
                                <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                                <span class="text-heading capitalize text-sm">{{ language.name }}</span>
                            </li>
                        </ul>
                    </div>

                    <button
                        class="webcart flex items-center justify-center gap-1.5 w-fit rounded-3xl capitalize text-sm font-medium h-8 px-2.5 transition text-white bg-heading">
                        <i class="fa-solid fa-bag-shopping text-sm"></i>
                        <span class="whitespace-nowrap text-sm">
                            {{ currencyFormat(subtotal, setting.site_digit_after_decimal_point,
        setting.site_default_currency_symbol, setting.site_currency_position) }}
                        </span>
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center justify-end gap-3 w-full mt-4  lg:flex-row lg:w-fit lg:mt-0">
                <form @submit.prevent="search"
                    class="header-search-group group   border border-solid gap-2  w-full lg:w-52 h-25  bg-[#fff] ">
                    <!--<button type="submit" class="header-search-submit">
                        <i class="lab lab-search-normal"></i>
                    </button>-->
                    <input type="search"  v-model="searchItem" placeholder="Search, Order, Enjoy, Repeat"
                        class="header-search-field p-2 w-full h-full  appearance-none placeholder:font-normal placeholder:text-paragraph text-heading">
                    <!--<button type="button" @click.prevent="searchReset"
                        class="header-search-button transition invisible group-focus-within:visible">
                        <i class="lab lab-close-circle-line lab-font-size-16 lab-font-weight-600 text-red-500"></i>
                    </button>-->
                </form>

                <div v-if="setting.site_language_switch === enums.activityEnum.ENABLE"
                    class="hidden lg:block relative dropdown-group w-full sm:w-fit">
                    <button
                        class="flex items-center justify-center gap-1.5 w-fit rounded-3xl capitalize text-sm font-medium h-8 px-3 border transition text-heading bg-white border-gray-200 dropdown-btn">
                        <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                        <span class="whitespace-nowrap">{{ language.name }}</span>
                    </button>
                    <ul v-if="languages.length > 0"
                        class="p-2 min-w-[180px] rounded-lg shadow-xl absolute top-14 ltr:right-0 rtl:left-0 z-10 border border-gray-200 bg-white hidden dropdown-list">
                        <li @click="changeLanguage(language.id, language.code)" v-for="language in languages"
                            class="flex items-center gap-2 py-1.5 px-2.5 rounded-md cursor-pointer hover:bg-gray-100">
                            <img :src="language.image" alt="flag" class="w-4 h-4 rounded-full">
                            <span class="text-heading capitalize text-sm">{{ language.name }}</span>
                        </li>
                    </ul>
                </div>

                <button
                    class="webcart hidden lg:flex items-center justify-center gap-1.5 w-fit rounded-3xl capitalize text-sm font-medium h-8 px-3 transition text-white bg-heading">
                    <i class="fa-solid fa-bag-shopping text-sm"></i>
                    <span class="whitespace-nowrap">
                        {{ currencyFormat(subtotal, setting.site_digit_after_decimal_point,
        setting.site_default_currency_symbol, setting.site_currency_position) }}
                    </span>
                </button>
            </div>
        </div>
    </header>



<button class="menu-button-fixed">
    <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_334_449)">
<path d="M25.3188 10.9546C25.1903 10.9546 25.1501 10.917 25.147 10.7933C25.137 10.4476 25.0885 10.1045 25.0128 9.76929C24.2154 6.25142 22.1038 3.91471 18.6903 2.7534C18.5196 2.69544 18.2882 2.70275 18.1843 2.58944C18.0768 2.47195 18.164 2.24115 18.1488 2.06048C18.1483 2.05421 18.1488 2.04742 18.1483 2.04116C18.0679 1.16078 17.6329 0.515374 16.8173 0.178573C16.009 -0.155616 15.245 -0.0146299 14.5808 0.558192C14.0174 1.04433 13.8132 1.68556 13.8576 2.41242C13.867 2.56594 13.8159 2.62286 13.6728 2.6615C10.9643 3.39932 8.99413 5.04416 7.7357 7.54171C7.22188 8.56151 6.93886 9.65284 6.85584 10.7938C6.84957 10.8799 6.8574 10.9671 6.72373 10.952C6.37596 10.9123 6.14569 11.0763 6 11.3807V12.0057C6.05013 12.023 6.03499 12.0679 6.04177 12.1039C6.37805 13.9863 7.88138 15.2484 9.79305 15.2484C13.9078 15.2495 18.0225 15.2484 22.1377 15.2495C22.4186 15.2495 22.6959 15.2239 22.9716 15.1717C24.6462 14.8531 25.9621 13.3336 26.0033 11.6689C26.0153 11.188 25.7971 10.953 25.3193 10.9541L25.3188 10.9546ZM15.0257 2.20512C15.0309 1.59261 15.4936 1.14772 16.0711 1.1848C16.6288 1.22083 17.0361 1.72733 16.9818 2.30851C16.9739 2.39101 16.9473 2.40354 16.8758 2.39676C16.293 2.33984 15.7098 2.34193 15.127 2.39519C14.9276 2.41346 15.0795 2.24898 15.0252 2.20512H15.0257ZM8.03124 10.7311C8.20461 9.13119 8.78944 7.69992 9.8155 6.46133C11.1209 4.8849 12.7908 3.90531 14.8169 3.62177C17.5196 3.24372 19.8568 4.04629 21.7717 5.99608C23.0337 7.28114 23.7418 8.84661 23.9632 10.633C23.9893 10.845 23.8943 10.951 23.6781 10.951C21.12 10.951 18.5619 10.951 16.0032 10.951C13.4446 10.951 10.8217 10.9483 8.23071 10.9562C8.04064 10.9567 8.01297 10.8993 8.03124 10.7316V10.7311ZM22.6358 14.0386C22.5074 14.0563 22.3774 14.0741 22.2479 14.0741C18.0543 14.0756 13.8613 14.0803 9.66773 14.072C8.53932 14.0699 7.55346 13.284 7.25948 12.1969C7.25478 12.1786 7.25634 12.1587 7.25478 12.1311H24.7459C24.5151 13.096 23.6186 13.9038 22.6358 14.0386Z" fill="white"/>
</g>
<path d="M0.792614 29V22.4545H2.26705V23.5668H2.34375C2.48011 23.1918 2.70597 22.8991 3.02131 22.6889C3.33665 22.4759 3.71307 22.3693 4.15057 22.3693C4.59375 22.3693 4.96733 22.4773 5.27131 22.6932C5.57813 22.9062 5.79403 23.1974 5.91903 23.5668H5.98722C6.1321 23.2031 6.37642 22.9134 6.72017 22.6974C7.06676 22.4787 7.47727 22.3693 7.9517 22.3693C8.55398 22.3693 9.04545 22.5597 9.42614 22.9403C9.80682 23.321 9.99716 23.8764 9.99716 24.6065V29H8.45028V24.8452C8.45028 24.4389 8.34233 24.142 8.12642 23.9545C7.91051 23.7642 7.64631 23.669 7.33381 23.669C6.96165 23.669 6.67045 23.7855 6.46023 24.0185C6.25284 24.2486 6.14915 24.5483 6.14915 24.9176V29H4.63636V24.7812C4.63636 24.4432 4.53409 24.1733 4.32955 23.9716C4.12784 23.7699 3.86364 23.669 3.53693 23.669C3.31534 23.669 3.11364 23.7259 2.93182 23.8395C2.75 23.9503 2.60511 24.108 2.49716 24.3125C2.3892 24.5142 2.33523 24.75 2.33523 25.0199V29H0.792614ZM14.4599 29.1278C13.8036 29.1278 13.2369 28.9915 12.7596 28.7188C12.2852 28.4432 11.9201 28.054 11.6644 27.5511C11.4087 27.0455 11.2809 26.4503 11.2809 25.7656C11.2809 25.0923 11.4087 24.5014 11.6644 23.9929C11.9229 23.4815 12.2837 23.0838 12.7468 22.7997C13.2099 22.5128 13.7539 22.3693 14.3789 22.3693C14.7823 22.3693 15.163 22.4347 15.521 22.5653C15.8817 22.6932 16.1999 22.892 16.4755 23.1619C16.7539 23.4318 16.9727 23.7756 17.1317 24.1932C17.2908 24.608 17.3704 25.1023 17.3704 25.6761V26.1491H12.0053V25.1094H15.8917C15.8888 24.8139 15.8249 24.5511 15.6999 24.321C15.5749 24.0881 15.4002 23.9048 15.1758 23.7713C14.9542 23.6378 14.6957 23.571 14.4002 23.571C14.0849 23.571 13.8079 23.6477 13.5692 23.8011C13.3306 23.9517 13.1445 24.1506 13.011 24.3977C12.8803 24.642 12.8136 24.9105 12.8107 25.2031V26.1108C12.8107 26.4915 12.8803 26.8182 13.0195 27.0909C13.1587 27.3608 13.3533 27.5682 13.6033 27.7131C13.8533 27.8551 14.146 27.9261 14.4812 27.9261C14.7056 27.9261 14.9087 27.8949 15.0906 27.8324C15.2724 27.767 15.43 27.6719 15.5636 27.5469C15.6971 27.4219 15.7979 27.267 15.8661 27.0824L17.3065 27.2443C17.2156 27.625 17.0423 27.9574 16.7866 28.2415C16.5337 28.5227 16.2099 28.7415 15.815 28.8977C15.4201 29.0511 14.9684 29.1278 14.4599 29.1278ZM20.218 25.1648V29H18.6754V22.4545H20.1499V23.5668H20.2266C20.3771 23.2003 20.6172 22.9091 20.9467 22.6932C21.2791 22.4773 21.6896 22.3693 22.1783 22.3693C22.63 22.3693 23.0234 22.4659 23.3587 22.6591C23.6967 22.8523 23.9581 23.1321 24.1428 23.4986C24.3303 23.8651 24.4226 24.3097 24.4197 24.8324V29H22.8771V25.071C22.8771 24.6335 22.7635 24.2912 22.5362 24.044C22.3118 23.7969 22.0007 23.6733 21.603 23.6733C21.3331 23.6733 21.093 23.733 20.8828 23.8523C20.6754 23.9687 20.5121 24.1378 20.3928 24.3594C20.2763 24.581 20.218 24.8494 20.218 25.1648ZM30.1598 26.2472V22.4545H31.7024V29H30.2067V27.8366H30.1385C29.9908 28.2031 29.7479 28.5028 29.4098 28.7358C29.0746 28.9687 28.6612 29.0852 28.1697 29.0852C27.7408 29.0852 27.3615 28.9901 27.032 28.7997C26.7053 28.6065 26.4496 28.3267 26.2649 27.9602C26.0803 27.5909 25.9879 27.1449 25.9879 26.6222V22.4545H27.5305V26.3835C27.5305 26.7983 27.6442 27.1278 27.8714 27.3722C28.0987 27.6165 28.397 27.7386 28.7663 27.7386C28.9936 27.7386 29.2138 27.6832 29.4268 27.5724C29.6399 27.4616 29.8146 27.2969 29.951 27.0781C30.0902 26.8565 30.1598 26.5795 30.1598 26.2472Z" fill="white"/>
<defs>
<clipPath id="clip0_334_449">
<rect width="20.0033" height="15.25" fill="white" transform="translate(6)"/>
</clipPath>
</defs>
</svg>

</button>




</template>

<script>
import statusEnum from "../../../enums/modules/statusEnum";
import appService from "../../../services/appService";
import LoadingComponent from "../../frontend/components/LoadingComponent";
import activityEnum from "../../../enums/modules/activityEnum";

export default {
    name: "TableNavbarComponent",
    components: { LoadingComponent },
    data() {
        return {
            loading: {
                isActive: false,
            },
            searchItem: "",
            enums: {
                activityEnum: activityEnum,
            },
            languageProps: {
                paginate: 0,
                order_column: "id",
                order_type: "asc",
                status: statusEnum.ACTIVE
            }
        }
    },
    computed: {
        setting: function () {
            return this.$store.getters['frontendSetting/lists'];
        },
        language: function () {
            return this.$store.getters['frontendLanguage/show'];
        },
        languages: function () {
            return this.$store.getters['frontendLanguage/lists'];
        },
        subtotal: function () {
            return this.$store.getters['tableCart/subtotal'];
        }
    },
    mounted() {
        this.loading.isActive = true;
        this.$store.dispatch('frontendSetting/lists').then(res => {
            this.defaultLanguage = res.data.data.site_default_language;
            const globalState = this.$store.getters['globalState/lists'];

            if (globalState.language_id > 0) {
                this.defaultLanguage = globalState.language_id;
            }

            this.$store.dispatch('frontendLanguage/lists', this.languageProps).then().catch();
            this.$store.dispatch('frontendLanguage/show', this.defaultLanguage).then(res => {
                this.$i18n.locale = res.data.data.code;
                this.$store.dispatch("globalState/init", {
                    language_code: res.data.data.code
                });
            }).catch();

            window.setTimeout(() => {
                this.$store.dispatch('tableDiningTable/show', this.$route.params.slug).then(res => {
                    this.$store.dispatch('tableCart/initTable', res.data.data);
                }).catch((err) => { });
            }, 300);

            this.loading.isActive = false;
        }).catch((err) => {
            this.loading.isActive = false;
        });
    },
    methods: {
        changeLanguage: function (id, code) {
            this.defaultLanguage = id;
            this.$store.dispatch("globalState/set", { language_id: id, language_code: code }).then(res => {
                this.$store.dispatch('frontendLanguage/show', id).then(res => {
                    this.$i18n.locale = res.data.data.code;
                }).catch();
            }).catch();
        },
        currencyFormat(amount, decimal, currency, position) {
            return appService.currencyFormat(amount, decimal, currency, position);
        },
        search: function () {
            if (typeof this.searchItem !== "undefined" && this.searchItem !== "") {
                this.$router.push({ name: "table.search", query: { s: this.searchItem } });
                this.searchItem = "";
            }
        },
        searchReset: function () {
            this.searchItem = "";
        },
    }
}
</script>
