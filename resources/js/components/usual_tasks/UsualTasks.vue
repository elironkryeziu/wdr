<template>
    <div>
        <div class="" >
            <div class="col-md-12 p20">
                <button @click="addUsualTask" class="py-1 px-4 lg:my-0 my-2 rounded font-semibold text-sm tracking-widest text-white uppercase bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                    Add Task
                </button>
            </div>
            <div class="flex flex-wrap ">
                <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Tasks</p>
                    <ul class="list-group drag p10">
                        <draggable class="dragArea"
                                :options="{group:'ITEMS'}"
                                v-model="myList">
                            <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                                v-for="usual_task in $store.state.usual_tasks.usual_tasks" :key="usual_task.id" @click="getUsualTask(usual_task.id)">
                               {{ usual_task.name }}
                            </li>
                        </draggable>
                    </ul>
                </div>
                <div class="w-64 rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Daily tasks</p>
                    <ul class="list-group drag p10">
                        <draggable class="dragArea"
                                    :options="{group:'ITEMS'}"
                                    v-model="myList2">
                            <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                                v-for="daily_task in $store.state.usual_tasks.daily_tasks" :key="daily_task.id" @click="getUsualTask(daily_task.id)">
                                {{ daily_task.name }}
                            </li>
                        </draggable>
                    </ul>
                </div>
                <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Weekly tasks</p>
                    <ul class="list-group drag p10">
                        <draggable class="dragArea"
                                    :options="{group:'ITEMS'}"
                                    v-model="myList3">
                            <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                                v-for="weekly_task in $store.state.usual_tasks.weekly_tasks" :key="weekly_task.id" @click="getUsualTask(weekly_task.id)">
                                {{ weekly_task.name }}
                                <div class="text-xs flex flex-wrap" v-for="day in weekly_task.days" :key="day.id">
                                    {{ day }}
                                </div>
                            </li>
                        </draggable>
                    </ul>
                </div>
                <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                    <p class="text-center text-lg font-semibold text text-gray-700">Monthly tasks</p>
                    <ul class="list-group drag p10">
                        <draggable class="dragArea"
                                    :options="{group:'ITEMS'}"
                                    v-model="myList4">
                            <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                                v-for="monthly_task in $store.state.usual_tasks.monthly_tasks" :key="monthly_task.id" @click="getUsualTask(monthly_task.id)">
                                <p>{{ monthly_task.name }}</p>
                                <p>{{ monthly_task.day_of_month }}</p>
                            </li>
                        </draggable>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Draggable from 'vuedraggable'
import NewUsualTaskModal from './NewUsualTaskModal'
import UsualTaskModal from './UsualTaskModal'

export default {
    components: {
        Draggable,
        NewUsualTaskModal,
        UsualTaskModal
    },
    data() {
        return {
        
        }
    },
    computed: {
        myList: {
            get() {
                return this.items;
            },
            set(value) {
                this.items = value;
            }
        },
        myList2: {
            get() {
                return this.items2;
            },
            set(value) {
                this.items2 = value;
            }
        },
        myList3: {
            get() {
                return this.items3;
            },
            set(value) {
                this.items3 = value;
            }
        },
        myList4: {
            get() {
                return this.items4;
            },
            set(value) {
                this.items4 = value;
            }
        }
    },
    mounted() {
      this.$store.dispatch('getUsualTasks'); 
    },
    methods: {
        insertItem: function(){
          var self = this;
          var no = 0;
          　
          if(self.items.concat().length > 0){
              no =  Math.max.apply(null, self.items.concat().map(function(item){return item.no;})) +1;

              self.newNo = self.newNo < no ? no:self.newNo;
          }
            if(self.items2.concat().length > 0){
                no =  Math.max.apply(null, self.items2.concat().map(function(item){return item.no;})) +1;

                self.newNo = self.newNo < no ? no:self.newNo;
            }
            if(self.items3.concat().length > 0){
                no =  Math.max.apply(null, self.items3.concat().map(function(item){return item.no;})) +1;

                self.newNo = self.newNo < no ? no:self.newNo;
            }
            if(self.items4.concat().length > 0){
                no =  Math.max.apply(null, self.items4.concat().map(function(item){return item.no;})) +1;

                self.newNo = self.newNo < no ? no:self.newNo;
            }

          this.items.push(
            {
              no:　this.newNo,
              name:'New item'+ this.newNo,
              categoryNo:'5'
            }
          );
        },
        deleteItem: function(item, index, group){
            switch (group) {
                case '':
                    var ITEMS = this.items;
                    break;
                case '2':
                    var ITEMS = this.items2;
                    break;
                case '3':
                    var ITEMS = this.items3;
                    break;
                case '4':
                    var ITEMS = this.items4;
                    break;
            }

            ITEMS.splice(index, 1);
        },
        addUsualTask() {
            this.$modal.show(NewUsualTaskModal, {},{ 
                name: "add-usual-task-modal",
                height: 'auto',
                clickToClose: false,
                draggable: true
            });
        },
        getUsualTask(id) {
            // console.log(id);
            this.$modal.show(UsualTaskModal, 
            {
                id: id
            },
            { 
                name: "usual-task-modal",
                height: 'auto',
                clickToClose: false,
                draggable: true
            });
        }
    }
}
</script>

<style scoped>
    .p10{
    padding:10px
}
.p20{
  padding:20px
}

.normal {
    background-color: grey;
}

.dragArea{
     min-height: 10px;	
}

.sortable-chosen {
    opacity: 0.7;
    background-color:#dcdcdc;
}
.sortable-ghost {
    background-color:#dcdcdc;
}

.del {
    cursor: pointer;
    color: red;
}
</style>