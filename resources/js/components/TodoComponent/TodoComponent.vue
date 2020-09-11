<template>
  <div class="TodoComponent w-25">
    <form @submit.prevent="saveTodo">
      <div class="input-group mb-3 w-100">
        <input type="text"
               v-model="form.title"
               class="form-control form-control-lg"
               :class="{'is-invalid' : form.errors.has('title')}"
               placeholder="Enter your todo"
               @keydown="form.errors.clear('title')"
        >
        <div class="input-group-append">
          <button class="btn btn-success" type="submit" id="button-addon2">Add this to your list</button>
        </div>

        <div class="text-danger pt-3" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></div>

      </div>
    </form>

    <div class="w-25">
      <div v-for="todo in todos" :key="todo.id" class="w-100">
        {{ todo.title }}
      </div>
    </div>
  </div>
</template>

<script>
 export default {
  data() {
    return {
      todos: [],
      form: new Form({
        title: ''
      })
    }
  },
   methods: {
     saveTodo(){
       let data = new FormData();
       data.append('title', this.form.title);
       axios.post('/api/todos', data).then((res) => {
         this.form.reset();
         this.getTodos();
       }).catch((error) => {
         this.form.errors.record(error.response.data.errors)
       })
     },
     getTodos(){
       axios.get('/api/todos').then((res) => {
         this.todos = res.data;
       }).catch((error) => {
         console.log('error', error);
       })
     },
   },
   mounted(){
     this.getTodos();
   }
};
</script>
