<template>
    <div class="container">
        <h3>Problem 1</h3>
        <hr>
        <div class="row">
            <div class="col-sm-5">
                <h4>  Input:</h4>
                <p>Enter the match results in the textarea:</p> 
                <div class="mb-3">
                    <textarea class="form-control" id="input-1" rows="8" v-model.trim="input1" ></textarea>
                    <span class="text-danger" v-if="req==true">Error, teams or categories must not exceed 16 characters</span>
                    <button class="form-control  btn btn-primary" @click.prevent="calculate()">Calculate</button>
                </div>
            </div>
            <div class="col-sm-7">
                <h4>Output:</h4>
                
                <div v-for="(re, index) in result" :key="index">
                    <pre id="output-1"><strong>Category:</strong>   {{re[1].category}} <strong>Winner:</strong> <span v-if="re[1].points < re[0].points">{{re[0].team}}</span> <span v-else>Empate</span> <span> - {{ re[1].noMatch}}</span> </pre>   
                </div>   
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: 'problem-1',
    data(){
        return {
            input1: '',
            array: [],
            words: [],
            result: [],
            val: [],
            req: false,            
        }
    },
    methods: {
        async calculate(){
            let me = this;
             me.req = false;
             await me.validate();
            if(me.req == true)
            {
                me.result = [];
            }
            else{
                
                me.array = me.input1.split(/\n/);
                me.array.pop();
                axios.post('http://127.0.0.1:8000/api/padelLeague',{
                'array': me.array
                })
                .then(function(response){
                me.result = response.data
                me.req = false;
                me.array = [];
                me.val = [];
               // console.log(response.data);
                })
                .catch(function(error){
                console.log(error)
                })
            }    
        },
        inTo(){
            this.array = this.input1.split(/\n/);
        },
        validate(){
            this.val = this.input1.split(/\n| /);
            
            this.val.forEach(e => {
                if(e.length > 15)
                {
                    this.req = true;   
                } 
            });
        },
    }

}
</script>