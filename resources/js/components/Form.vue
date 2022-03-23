<template>
    <form @submit.prevent="onSubmit" ref="form">
        <template v-if="this.form.notifmsg">
            <div v-for="(errorArray, index) in form.notifmsg" :key="index">
                <div v-for="(allErrors, index) in errorArray" :key="index">
                    <span class="text-danger">{{ allErrors }} </span>
                </div>
            </div>
        </template>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Name:</label
                    ><input
                        class="form-control"
                        placeholder="Name"
                        name="name"
                        ref="name"
                        type="text"
                        v-model="v$.form.name.$model"
                    />
                    <div
                        class="pre-icon os-icon os-icon-user-male-circle"
                    ></div>
                    <!-- Error Message -->
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.name.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Surname:</label
                    ><input
                        class="form-control"
                        placeholder="Surname"
                        name="surname"
                        ref="surname"
                        type="text"
                        v-model="v$.form.surname.$model"
                    />
                    <!-- Error Message -->
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.surname.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for=""> Email:</label
                    ><input
                        class="form-control"
                        placeholder="Enter email"
                        type="email"
                        ref="email"
                        name="email"
                        v-model="v$.form.email.$model"
                    />
                    <div class="pre-icon os-icon os-icon-email-2-at2"></div>
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.email.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Phone:</label
                    ><input
                        @input="acceptNumber"
                        class="form-control"
                        name="phone"
                        ref="phone"
                        placeholder="Phone"
                        type="text"
                        v-model="v$.form.phone.$model"
                    />
                    <div class="pre-icon os-icon os-icon-fingerprint"></div>
                    <!-- Error Message -->
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.phone.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Company:</label
                    ><input
                        class="form-control"
                        placeholder="Company"
                        type="text"
                        name="company"
                        ref="company"
                        v-model="v$.form.company.$model"
                    />
                    <!-- Error Message -->
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.company.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Address:</label
                    ><input
                        class="form-control"
                        placeholder="Address"
                        type="text"
                        name="address"
                        ref="address"
                        v-model="v$.form.address.$model"
                    />
                    <!-- Error Message -->
                    <div
                        class="input-errors"
                        v-for="(error, index) of v$.form.address.$errors"
                        :key="index"
                    >
                        <div class="error-msg">{{ error.$message }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div clas="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Photo:</label
                    ><input
                        ref="fileupload"
                        name="file"
                        class="form-control"
                        type="file"
                        v-on:change="onChange"
                    />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <div class="buttons-w">
                    <button class="btn btn-primary btn-margin" >
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";
import useVuelidate from "@vuelidate/core";
import { required, email, minLength, sameAs } from "@vuelidate/validators";
import {api} from "../apiurl";


export function validName(name) {
    let validNamePattern = new RegExp("^[a-zA-Z]+(?:[-'\\s][a-zA-Z]+)*$");
    if (validNamePattern.test(name)) {
        return true;
    }
    return false;
}
export default {
    name: "Form",

    setup() {
        return { v$: useVuelidate() };
    },
    data() {
        return {
            form: {
                name: "",
                surname: "",
                email: "",
                phone: "",
                company: "",
                address: "",
                file: "",
                notifmsg: "",
                localdetail: this.userinfo,
                servererror: true,
            },
            servererror: true,
        };
    },
    validations() {
        return {
            form: {
                name: {
                    required,
                    name_validation: {
                        $validator: validName,
                        $message:
                            "Invalid Name. Valid name only contain letters, dashes (-) and spaces",
                    },
                },
                surname: {
                    required,
                    name_validation: {
                        $validator: validName,
                        $message:
                            "Invalid Name. Valid name only contain letters, dashes (-) and spaces",
                    },
                },
                email: { required, email },
                phone: { required },
                company: { required },
                address: { required },
                file: {},
            },
        };
    },
    methods: {
        acceptNumber() {
            var x = this.form.phone
                .replace(/\D/g, "")
                .match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
            this.form.phone = !x[2]
                ? x[1]
                : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
        },
        onChange(e) {
            this.form.file = e.target.files[0];
            const fileType = e.target.files[0]["type"];

            if (this.form.file.size > 2048 * 2048) {
                e.preventDefault();
                alert("File too big (> 2MB)");
                this.$refs.fileupload.value = null;
                return false;
            }
            if (
                fileType === "image/jpeg" ||
                fileType === "image/png" ||
                fileType === "image/jpg"
            ) {
                return true;
            } else {
                e.preventDefault();
                alert("File type should be jpg,jpeg,png");
                this.$refs.fileupload.value = null;
                return false;
            }
        },
        onSubmit(e) {
            e.preventDefault();
            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                },
            };
            let formData = new FormData();
            formData.append("file", this.form.file);
            formData.append("name", this.form.name);
            formData.append("surname", this.form.surname);
            formData.append("email", this.form.email);
            formData.append("phone", this.form.phone);
            formData.append("company", this.form.company);
            formData.append("address", this.form.address);

            axios
                .post(api+"/users", formData, config)
                .then((res) => {
                        this.getUser(res.data.data);
                        setTimeout(() => { this.$refs.form.reset() }, 0)
                        this.form.notifmsg = null;
                })
                .catch((err) => {
                    if (err.response && err.response.status == 422) {
                        this.form.notifmsg = err.response.data.errors;
                    }
            });
        },
    },
    props: {
        getUser: Function,
    },
};
</script>
