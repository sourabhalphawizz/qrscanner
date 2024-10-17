<template>
    <LoadingComponent :props="loading" />
    <div class="db-card db-tab-div active">
        <div class="db-card-header border-none">
            <h3 class="db-card-title">{{ $t("label.subscriptions") }}</h3>
            <div class="db-card-filter">
                <TableLimitComponent :method="list" :search="subscription.search" :page="paginationPage" />
            </div>
        </div>

        <div class="db-table-responsive">
            <table class="db-table stripe">
                <thead class="db-table-head">
                    <tr class="db-table-head-tr">
                        <th class="db-table-head-th">
                            {{ $t("label.plan") }}
                        </th>
                        <th class="db-table-head-th">
                            {{ $t("label.amount") }}
                        </th>
                        <th class="db-table-head-th">
                            {{ $t("label.start_date") }}
                        </th>
                        <th class="db-table-head-th">
                            {{ $t("label.end_date") }}
                        </th>
                        <th class="db-table-head-th">
                            {{ $t("label.validity") }}
                        </th>
                        <th class="db-table-head-th">
                            {{ $t("label.action") }}
                        </th>
                    </tr>
                </thead>
                <tbody class="db-table-body" v-if="subscriptions.length > 0">
                    <tr class="db-table-body-tr" v-for="subscription in subscriptions" :key="subscription">
                        <td class="db-table-body-td">
                            {{ subscription.plan }}
                        </td>
                        <td class="db-table-body-td">
                            {{ subscription.amount }}
                        </td>
                        <td class="db-table-body-td">
                            {{ subscription.start_date }}
                        </td>
                        <td class="db-table-body-td">
                            {{ subscription.end_date }}
                        </td>
                        <td class="db-table-body-td">
                            {{ subscription.validity }}
                        </td>
                        <td class="db-table-body-td">
                            <div class="flex justify-start items-center sm:items-start sm:justify-start gap-1.5">
                                <SmIconDeleteComponent @click="destroy(subscription.id)" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-6">
            <PaginationSMBox :pagination="pagination" :method="list" />
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <PaginationTextComponent :props="{ page: paginationPage }" />
                <PaginationBox :pagination="pagination" :method="list" />
            </div>
        </div>
    </div>
</template>

<script>
import alertService from "../../../../services/alertService";
import LoadingComponent from "../../components/LoadingComponent";
import TableLimitComponent from "../../components/TableLimitComponent";
import appService from "../../../../services/appService";
import SmIconDeleteComponent from "../../components/buttons/SmIconDeleteComponent";
import PaginationTextComponent from "../../components/pagination/PaginationTextComponent";
import PaginationBox from "../../components/pagination/PaginationBox";
import PaginationSMBox from "../../components/pagination/PaginationSMBox";

export default {
    name: "AdministratorSubscriptionList",
    components: {
        LoadingComponent,
        TableLimitComponent,
        SmIconDeleteComponent,
        PaginationSMBox,
        PaginationBox,
        PaginationTextComponent
    },
    props: ["props"],
    data() {
        return {
            loading: {
                isActive: false,
            },
            subscription: {
                form: {
                    plan: "",
                    amount: "",
                    start_date: "",
                    end_date: "",
                    validity: "",
                },
                search: {
                    paginate: 1,
                    page: 1,
                    per_page: 10,
                    order_column: "id",
                    order_type: "desc",
                },
            },
        }
    },
    mounted() {
        this.list();
    },
    computed: {
        subscriptions: function () {
            return this.$store.getters["administratorSubscription/lists"];
        },
        pagination: function () {
            return this.$store.getters["administratorSubscription/pagination"];
        },
        paginationPage: function () {
            return this.$store.getters["administratorSubscription/page"];
        },
    },
    methods: {
        list: function (page = 1) {
            this.loading.isActive = true;
            this.subscription.search.page = page;
            this.$store.dispatch("administratorSubscription/lists", {
                id: this.props,
                search: this.subscription.search
            }).then((res) => {
                this.loading.isActive = false;
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
        destroy: function (subscriptionId) {
            appService.destroyConfirmation().then((res) => {
                try {
                    this.loading.isActive = true;
                    this.$store.dispatch("administratorSubscription/destroy", {
                        id: this.props,
                        subscriptionId: subscriptionId,
                        search: this.subscription.search
                    }).then((res) => {
                        this.loading.isActive = false;
                        alertService.successFlip(null, this.$t("label.subscription"));
                    }).catch((err) => {
                        this.loading.isActive = false;
                        alertService.error(err.response.data.message);
                    });
                } catch (err) {
                    this.loading.isActive = false;
                    alertService.error(err.response.data.message);
                }
            }).catch((err) => {
                this.loading.isActive = false;
            });
        },
    }

}
</script>
