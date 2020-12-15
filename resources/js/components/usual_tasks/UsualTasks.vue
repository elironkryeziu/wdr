<template>
    <div>
        <div class="" >
          <div class="col-md-12 p20">
              <button class="bg-blue-500" type="button" v-on:click="insertItem">Add item</button>
          </div>
          <div class="flex flex-wrap ">
            <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                <ul class="list-group drag p10">
                    <draggable class="dragArea"
                            :options="{group:'ITEMS'}"
                            v-model="myList">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="(item, index) in myList"
                            :key="item.no">
                            <span class="badge">No.{{item.no}}</span>
                            <label>
                                {{item.name}}
                            </label>
                            <p><span class="del" v-on:click="deleteItem(item, index, '')">Delete</span></p>
                        </li>
                    </draggable>
                </ul>
            </div>
            <div class="w-64 rounded bg-gray-300  mx-6 shadow-md">
                <ul class="list-group drag p10">
                    <draggable class="dragArea"
                                :options="{group:'ITEMS'}"
                                v-model="myList2">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="(item, index) in myList2"
                            :key="item.no">
                            <span class="badge">No.{{item.no}}</span>
                            <label>
                                {{item.name}}
                            </label>
                            <p><span class="del" v-on:click="deleteItem(item, index, '2')">Delete</span></p>
                        </li>
                    </draggable>
                </ul>
            </div>
            <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                <ul class="list-group drag p10">
                    <draggable class="dragArea"
                                :options="{group:'ITEMS'}"
                                v-model="myList3">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="(item, index) in myList3"
                            :key="item.no">
                            <span class="badge">No.{{item.no}}</span>
                            <label>
                                {{item.name}}
                            </label>
                            <p><span class="del" v-on:click="deleteItem(item, index, '3')">Delete</span></p>
                        </li>
                    </draggable>
                </ul>
            </div>
            <div class="w-64  rounded bg-gray-300  mx-6 shadow-md">
                <ul class="list-group drag p10">
                    <draggable class="dragArea"
                                :options="{group:'ITEMS'}"
                                v-model="myList4">
                        <li class="p-4 mb-3 bg-white shadow rounded-lg cursor-pointer"
                            v-for="(item, index) in myList4"
                            :key="item.no">
                            <span class="badge">No.{{item.no}}</span>
                            <label>
                                {{item.name}}
                            </label>
                            <p><span class="del" v-on:click="deleteItem(item, index, '4')">Delete</span></p>
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

export default {
    components: {
        Draggable,
    },
    data() {
        return {
            items:[
              {no:1, name:'Item 1', categoryNo:'1'},
              {no:5, name:'Item 2', categoryNo:'1'},
              {no:9, name:'Item 3', categoryNo:'1'},
              {no:10, name:'Item 4', categoryNo:'1'}
        ],
        items2:[
            {no:2, name:'Item 5', categoryNo:'2'},
            {no:6, name:'Item 6', categoryNo:'2'},
            {no:11, name:'Item 7', categoryNo:'2'},
            {no:12, name:'Item 8', categoryNo:'2'}
        ],
        items3:[
            {no:3, name:'Item 9', categoryNo:'3'},
            {no:7, name:'Item 10', categoryNo:'3'},
            {no:13, name:'Item 11', categoryNo:'3'},
            {no:14, name:'Item 12', categoryNo:'3'},
        ],
        items4:[
            {no:4, name:'Item 13', categoryNo:'4'},
            {no:8, name:'Item 14', categoryNo:'4'},
            {no:15, name:'Item 15', categoryNo:'4'},
            {no:16, name:'Item 16', categoryNo:'4'},
        ],
        newNo: 0
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