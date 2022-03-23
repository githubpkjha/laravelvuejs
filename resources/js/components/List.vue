<template>
    <Form :getUser="newUserDetail"></Form>
    <h3 class="text-center">User List</h3>
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Address</th>
                    <!-- <th>Actions</th> -->
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="user in users"
                    :key="user.id"
                    @click="userDetail(user.id)"
                    data-bs-toggle="modal"
                    data-bs-target="#userModal"
                    class="pointer"
                >
                    <td>
                        <img v-bind:src="user.photo" class="user-photo" />
                    </td>
                    <td class="center">{{ user.name }} {{ user.surname }}</td>
                    <td class="center">{{ user.email }}</td>
                    <td class="center">{{ user.phone }}</td>
                    <td class="center">{{ user.company }}</td>
                    <td class="center">{{ user.address.substring(0, 30) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div
        class="modal fade"
        id="userModal"
        tabindex="-1"
        aria-labelledby="userModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="userModalLabel">
                        User Info
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label"
                            >Full Name</label
                        >
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                readonly
                                v-bind:value="
                                    this.details.name +
                                    ' ' +
                                    this.details.surname
                                "
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"
                            >Email</label
                        >
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                readonly
                                v-bind:value="this.details.email"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label"
                            >Phone</label
                        >
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                readonly
                                v-bind:value="this.details.phone"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-2 col-form-label"
                            >Company</label
                        >
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="company"
                                readonly
                                v-bind:value="this.details.company"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label"
                            >Address</label
                        >
                        <div class="col-sm-10">
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                readonly
                                v-bind:value="this.details.address"
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label"
                            >Photo</label
                        >
                        <div class="col-sm-10">
                            <img
                                v-bind:src="this.details.photo"
                                class="user-photo"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bootstrap from "bootstrap";
import axios from "axios";
import Form from "./Form.vue";
import css from "../css/style.css";
import {api} from "../apiurl";

export default {
    name: "List",
    data() {
        return {
            users: [],
            details: "",
        };
    },
    components: {
        Form,
    },
    created() {
        axios.get(api + "/users/").then((response) => {
            this.users = response.data;
        });
    },
    methods: {
        userDetail(id) {
            axios.get(api + "/users/" + id).then((response) => {
                this.details = response.data.data;
                console.log("thisdetail--" + this.details.name);
            });
        },
        newUserDetail(detail) {
            this.users.push(detail);
        },
    },
};
</script>
