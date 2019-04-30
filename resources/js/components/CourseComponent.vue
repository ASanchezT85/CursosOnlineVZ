<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-5 border">
                    <h5 class="text-center mb-2 mt-4">Tabla de Curos</h5>
                    <section class="py-4">
                        <div class="container">
                            <div class="d-block d-md-flex p-4 p-sm-5 all-text-white border-radius-3">
                                <div class="align-self-center text-center text-md-left">
                                    <select v-model="queryFiled" class="form-control" id="fileds">
                                        <option value="name">Name</option>
                                        <option value="category">Category</option>
                                        <option value="teacher">Teacher</option>
                                        <option value="status">Status</option>
                                    </select>
                                </div>
                                <div class="mt-3 mt-md-0 text-center text-md-right ml-md-auto align-self-center">
                                    <input v-model="query" type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="table-responsive-sm">
                        <table class="table table-lg table-noborder table-striped">
                            <thead class="all-text-white bg-grad">
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="text-center">Teacher</th>
                                    <th scope="col" class="text-center">Category</th>
                                    <th scope="col" class="text-center">Level</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Status</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show="courses.length" v-for="(course, index) in courses" :key="course.id">
                                <th scope="row" class="text-center">{{ index + 1 }}</th>
                                <td class="text-center">{{ course.teacher_id}}</td>
                                <td class="text-center">{{ course.category_id }}</td>
                                <td class="text-center">{{ course.level_id }}</td>
                                <td>{{ course.name }}</td>
                                <td class="text-center">{{ course.status }}</td>                    
                                <td class="text-center">
                                    <button type="button" @click="show(course)" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" @click="edit(course)" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" @click="destroy(course)" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-show="!courses.length">
                                <td colspan="7">
                                    <div class="alert alert-danger" role="alert">Sorry :( No data found.</div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <pagination
                            v-if="pagination.last_page > 1"
                            :pagination="pagination"
                            :offset="5"
                            @paginate="query === '' ? getData() : searchData()"
                        ></pagination>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customers</h4>
                            <div class="card-tools" style="position: absolute;right: 1rem;top: .5rem;">
                                <button type="button" class="btn btn-info" @click="create">
                                    Add New
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-primary" @click="reload">
                                    Reload
                                    <i class="fas fa-sync"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <strong>Search By :</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <select v-model="queryFiled" class="form-control" id="fileds">
                                            <option value="name">Name</option>
                                            <option value="category">Category</option>
                                            <option value="teacher">Teacher</option>
                                            <option value="status">Status</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            
            <!-- Modal -->
            <div
              class="modal fade"
              id="courseModalLong"
              ref="courseModalLong"
              tabindex="-1"
              role="dialog"
              aria-labelledby="courseModalLongTitle"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5
                      class="modal-title"
                      id="courseModalLongTitle"
                    >{{ editMode ? "Edit" : "Add New" }} Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
                    <div class="modal-body">
                      <alert-error :form="form"></alert-error>
                      <div class="form-group">
                        <label>Teacher</label>
                        <input
                          v-model="form.teacher"
                          type="text"
                          name="teacher"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('teacher') }"
                        >
                        <has-error :form="form" field="teacher"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <input
                          v-model="form.category"
                          type="text"
                          name="category"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('category') }"
                        >
                        <has-error :form="form" field="category"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Level</label>
                        <input
                          v-model="form.level"
                          type="text"
                          name="level"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('level') }"
                        >
                        <has-error :form="form" field="level"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Name</label>
                        <input
                          v-model="form.name"
                          type="text"
                          name="name"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                        >
                        <has-error :form="form" field="name"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Slug</label>
                        <input
                          v-model="form.slug"
                          type="text"
                          name="slug"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('slug') }"
                        >
                        <has-error :form="form" field="slug"></has-error>
                      </div>

                      <div class="form-group">
                        <label>Picture</label>
                        <input
                          v-model="form.picture"
                          type="text"
                          name="picture"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('picture') }"
                        >
                        <has-error :form="form" field="picture"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <input
                          v-model="form.status"
                          type="text"
                          name="status"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('status') }"
                        >
                        <has-error :form="form" field="status"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Address</label>
                        <textarea
                          v-model="form.address"
                          name="address"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('address') }"
                        ></textarea>
                        <has-error :form="form" field="address"></has-error>
                      </div>
                      <div class="form-group">
                        <label>Approved</label>
                        <input
                          v-model="form.approved"
                          type="number"
                          name="approved"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('approved') }"
                        >
                        <has-error :form="form" field="approved"></has-error>
                      </div>
                       <div class="form-group">
                        <label>Rejected</label>
                        <input
                          v-model="form.rejected"
                          type="number"
                          name="rejected"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('rejected') }"
                        >
                        <has-error :form="form" field="rejected"></has-error>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div
              class="modal fade"
              id="showModal"
              ref="showModal"
              tabindex="-1"
              role="dialog"
              aria-labelledby="showModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">{{ form.name }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <strong>Teacher : {{ form.teacher }}</strong>
                    <br>
                    <strong>Category : {{ form.category }}</strong>
                    <br>
                    <strong>Level : {{ form.level }}</strong>
                    <br>
                    <strong>Description :</strong>
                    <p>{{ form.description }}</p>
                    <br>
                    <strong>Status : {{ form.status }}</strong>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <b-modal ref="showModal" size="lg" ok-only>
                <template slot="modal-title">
                    {{ form.name }}
                </template>
                <template slot="default" slot-scope="{ hide }">
                    <p>Modal Body with button</p>
                    <b-button @click="hide()">Hide Modal</b-button>
                </template>
            </b-modal>

            <vue-progress-bar></vue-progress-bar>
            <vue-snotify></vue-snotify>
        </div>
    </section>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      editMode: false,
      query: "",
      queryFiled: "name",
      courses: [],
      form: new Form({
        id: "",
        teacher: "",
        category: "",
        level: "",
        name: "",
        description: "",
        slug: "",
        picture: "",
        status: "",
        approved: "",
        rejected: ""
      }),
      pagination: {
        current_page: 1
      }
    };
  },
  watch: {
    query: function(newQ, old) {
      if (newQ === "") {
        this.getData();
      } else {
        this.searchData();
      }
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      this.$Progress.start();
      axios
        .get("/api/courses?page=" + this.pagination.current_page)
        .then(response => {
          this.courses = response.data.data;
          this.pagination = response.data.meta;
          this.$Progress.finish();
        })
        .catch(e => {
          console.log(e);
          this.$Progress.fail();
        });
    },
    searchData() {
      this.$Progress.start();
      axios
        .get(
          "/api/search/courses/" +
            this.queryFiled +
            "/" +
            this.query +
            "?page=" +
            this.pagination.current_page
        )
        .then(response => {
          this.courses = response.data.data;
          this.pagination = response.data.meta;
          this.$Progress.finish();
        })
        .catch(e => {
          console.log(e);
          this.$Progress.fail();
        });
    },
    reload() {
      this.getData();
      this.query = "";
      this.queryFiled = "name";
      this.$snotify.success("Data Successfully Refresh", "Success");
    },
    create() {
      this.editMode = false;
      this.form.reset();
      this.form.clear();
      this.$refs.courseModalLong.show();
      //$("#courseModalLong").modal("show");
    },
    store() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .post("/api/courses")
        .then(response => {
          this.getData();
          this.$refs.courseModalLong.hide();
          //$("#courseModalLong").modal("hide");
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("Customer Successfully Saved", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
              "Something went wrong try again later.",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    },
    show(course) {
      this.form.reset();
      this.form.fill(course);
      //$("#showModal").modal("show");
      this.$refs.showModal.show();
      console.log(course);
    },
    edit(course) {
      this.editMode = true;
      this.form.reset();
      this.form.clear();
      this.form.fill(course);
     this.$refs.courseModalLong.show();
    },
    update() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .put("/api/courses/" + this.form.id)
        .then(response => {
          this.getData();
          this.$refs.courseModalLong.hide();
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("Customer Successfully Updated", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
              "Something went wrong try again later.",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    },
    destroy(course) {
      this.$snotify.clear();
      this.$snotify.confirm(
        "You will not be able to recover this data!",
        "Are you sure?",
        {
          showProgressBar: false,
          closeOnClick: false,
          pauseOnHover: true,
          buttons: [
            {
              text: "Yes",
              action: toast => {
                this.$snotify.remove(toast.id);
                this.$Progress.start();
                axios
                  .delete("/api/courses/" + course.id)
                  .then(response => {
                    this.getData();
                    this.$Progress.finish();
                    this.$snotify.success(
                      "Customer Successfully Deleted",
                      "Success"
                    );
                  })
                  .catch(e => {
                    this.$Progress.fail();
                    console.log(e);
                  });
              },
              bold: true
            },
            {
              text: "No",
              action: toast => {
                this.$snotify.remove(toast.id);
              },
              bold: true
            }
          ]
        }
      );
    }
  }
};
</script>