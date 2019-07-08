<template>
    <div class="contenedor-create ">
        <div class="create"> <h1>Crear curso</h1></div>
        <form @submit.prevent ref="formulario">
            <div class="crear-curso">
                <b-form-group
                    id="fieldset-1"
                    label="Nombre del curso"
                    label-for="input-1"
                >
                    <div class="d-flex flex-row align-items-center">
                    <b-form-input id="input-1" v-model="course[0].name" trim></b-form-input>
                    <i class="fas fa-plus" @click="createLesson"></i>
                    </div>
                </b-form-group>
                <div class="crear-leccion ml-4" v-for="(lesson, k) in course[0].lessons" :key="'lesson-' + k">
                    <b-form-group
                        :id="'lesson-' + k"
                        label="Nombre de la lección"
                        :label-for="'lesson-' + k"
                    >
                        <div class="d-flex flex-row align-items-center">
                        <b-form-input :id="'lesson-' + k" v-model="course[0].lessons[k].name" trim></b-form-input>
                        <i class="fas fa-plus" @click="createChapter(k)"></i>
                        <i class="fas fa-minus"></i>
                        </div>
                    </b-form-group>
                    <div class="crear-capitulo" v-for="(chapter, j) in course[0].lessons[k].chapters" :key="'chapter-' + j">
                        <b-form-group
                            :id="'chapter-' + j"
                            label="Nombre del  capítulo"
                            :label-for="'chapter-' + j"
                        >
                            <div class="d-flex flex-row align-items-center">
                                <b-form-input :id="'chapter-' + j" v-model="course[0].lessons[k].chapters[j].name" trim></b-form-input>
                                <i class="fas fa-plus" @click="createScreenQuestion(j, k)"></i>
                                <i class="fas fa-minus"></i>
                            </div>
                        </b-form-group>
                        <div class="crear-pantalla ml-4 my-2" v-for="(screen, l) in course[0].lessons[k].chapters[j].screens" :key="'screen-' + l">
                            <b-form-group
                                :id="'screen-text-' + l"
                                label="Nombre de la pantalla"
                                :label-for="'screen-text-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'screen-text-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].text" trim></b-form-textarea>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'screen-order-' + l"
                                label="Orden de la pantalla"
                                :label-for="'screen-order-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                <b-form-input :id="'screen-order-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].order" type="number" trim></b-form-input>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'screen-url-' + l"
                                label="Url de la imagen de la pantalla"
                                :label-for="'screen-url-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-input :id="'screen-url-' + l" v-model="course[0].lessons[k].chapters[j].screens[l].image_url" trim></b-form-input>
                                </div>
                            </b-form-group>
                        </div>
                        <div class="crear-pregunta ml-4 my-2" v-for="(question, l) in course[0].lessons[k].chapters[j].questions" :key="'question-' + l">
                            <div class="text-right">
                                <i class="fas fa-plus" @click="createAnswer(l, j, k)"></i>
                                <i class="fas fa-minus"></i>
                            </div>
                            <b-form-group
                                :id="'question-text-' + l"
                                label="Nombre de la pregunta"
                                :label-for="'question-text-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'question-text-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].name" trim></b-form-textarea>
                                </div>
                            </b-form-group>
                            <b-form-group
                                :id="'question-order-' + l"
                                label="Orden de la pregunta"
                                :label-for="'question-order-' + l"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-input :id="'question-order-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].order" type="number" trim></b-form-input>
                                </div>
                            </b-form-group>
                            <div class="crear-respuesta ml-4 my-2" v-for="(answer, p) in course[0].lessons[k].chapters[j].questions[l].answers" :key="'answer-' + p">
                                <b-form-group
                                    :id="'answer-text-' + p"
                                    label="Nombre de la respuesta"
                                    :label-for="'answer-text-' + p"
                                >
                                <div class="d-flex flex-row align-items-center">
                                    <b-form-textarea rows="3" max-rows="6" :id="'answer-text-' + l" v-model="course[0].lessons[k].chapters[j].questions[l].answers[p].name" trim></b-form-textarea>
                                </div>
                                </b-form-group>
                                <span>Respuesta falsa o verdadera</span>
                                <b-form-select v-model="course[0].lessons[k].chapters[j].questions[l].answers[p].is_correct">
                                    <option value="0">Falsa</option>
                                    <option value="1">Verdadera</option>
                                </b-form-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button @click="createCourse">Guardar curso</button>
        </form>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    computed: {
        state() {
        return this.courseName.length
        }
    },
    data() {
        return {
            course:[{
                name: '',
                lessons: [
                    {
                        name:'',
                        chapters: [
                            {
                                name:'',
                                screens: [
                                    {
                                        text: '',
                                        order: '',
                                        image_url: ''
                                    }
                                ],
                                questions: [
                                    {
                                        name: '',
                                        order: '',
                                        answers: [
                                            {
                                                name: '',
                                                is_correct: 'Respuesta falsa o verdadera'
                                            }
                                        ]
                                    }
                                ]
                            }
                        ]
                    }
                ]
            }]
        }
    },
    methods: {
        createLesson() {
            this.course[0].lessons.push({
                name:'',
                chapters: [
                {
                    name:'',
                    screens: [
                        {
                            text: '',
                            order: '',
                            image_url: ''
                        }
                    ],
                    questions: [
                        {
                            name: '',
                            order: '',
                            answers: [
                                {
                                    name: '',
                                    is_correct: ''
                                }
                            ]
                        }
                    ]
                }
                ]
            })
        },
        createChapter(k) {
            this.course[0].lessons[k].chapters.push({
                name:'',
                screens: [
                    {
                        text: '',
                        order: '',
                        image_url: ''
                    }
                ],
                questions: [
                    {
                        name: '',
                        order: '',
                        answers: [
                            {
                                name: '',
                                is_correct: ''
                            }
                        ]
                    }
                ]
            })
        },
        createScreenQuestion(j, k) {
            this.course[0].lessons[k].chapters[j].screens.push({
                text: '',
                order: '',
                image_url: ''
            })
            this.course[0].lessons[k].chapters[j].questions.push({
                name: '',
                order: '',
                answers: [
                    {
                        name: '',
                        is_correct: ''
                    }
                ]
            })
        },
        createAnswer(l, j, k) {
            this.course[0].lessons[k].chapters[j].questions[l].answers.push({
                name: '',
                is_correct: ''
            })
        },
        createCourse() {
            console.log(this.course[0]);
            Axios.defaults.headers.common['Authorization'] = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQwZGQ5ZGMwNjc4MzNiYmRlMmVjOGZjYzUzNDY4YjVjZjk2ODZlMmUxZmNmNjM5M2JhZjFiNWI2Yjk5NzA5ZTkzNzZlN2JhYzMzMjA4NGQxIn0.eyJhdWQiOiIyIiwianRpIjoiZDBkZDlkYzA2NzgzM2JiZGUyZWM4ZmNjNTM0NjhiNWNmOTY4NmUyZTFmY2Y2MzkzYmFmMWI1YjZiOTk3MDllOTM3NmU3YmFjMzMyMDg0ZDEiLCJpYXQiOjE1NjI2MDYxMDAsIm5iZiI6MTU2MjYwNjEwMCwiZXhwIjoxNTk0MjI4NTAwLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.HSwoS2qHiByQDt1hrV_VvVCZqvHMhEG3fIP3De7AYPrkcOB5t238Yr4amHM2GlX7jiIeam82unc3bSoPlreV-PG65jWqDGCDx95MT9Iax3o5hFI7P2Ct0Z_Umvj2t_IHb-KzHcU3SC3SPDaU1E6usFjaiBsSCjMBHYETlIP-_2YQWIwwxC4G0FeYSntsZwAo4Iaug830x4vcpnfZp5tx-g0euIWXvkMce2kx1_4nSsKnkMVJAuZColGw9yF2ZBBVsNZcxBK-he8i0TYoUgQQi7ChNqzpSL3EIWoyjbsF7DMbM7VQH5Y2OebniCnJ4y2KIgOWjiF6AIKT7F9vqtdZp6P4PavcT2upS4PYCo11-vdNpZDAAvNhJ17zy3rrC5-GOsnj7u_mmPc5ScHGsu3e7NRwArELJOL6_y6T8wy2lcJTw96R2C1bOyI6Q-Ja6Le0MdGGD_eWLfbj-INbbNq4JDogS42n4cMRxVdON6DxuwI906AjKnnLMbow9aYIxsr9esjJ7hngu_Yw5SJDYwpVD-kfo73EOZAjqF0mVq28eWEhzf9ONZZC26TOqhaqEvN87njLryK1DGewy4bVm4H8p0I6QEUq7PxNEfHa6iIj0yjY9fXdYmT1TJmmvXY3I-cZuG1-f7sCmQJn_TUtkIJ46M-VH-36ND0BCoeEJvDD7N8'
            var courseObject = {course: this.course}
            Axios.post('/api/course/add', {
                course: JSON.stringify(courseObject),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                    console.log('todo bien');

            })
        }
    }
}
</script>

<style lang="scss" scoped>
.contenedor-create {
    max-width: 65;
    width: 55vw;
    display: flex;
    flex-direction: column;
}

i.fas.fa-plus, .fa-minus {
    font-size: 1.5rem;
    margin-left: 1.2rem;
    cursor: pointer;
}

.crear-capitulo {
    margin-left: 4rem;
}

.crear-pantalla,
.crear-pregunta  {
    border: 3px solid grey;
    padding: 15px;
    border-radius: 10px;
}

</style>
