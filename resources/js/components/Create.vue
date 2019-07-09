<template>
    <div class="main-container-course">
        <div class="contenedor-create ml-3">
            <div class="create-body">
                <div class="create text-center d-flex justify-content-center">
                    <h1>Crear curso</h1>
                </div>
                <form @submit.prevent ref="formulario">
                    <div class="crear-curso">
                        <b-form-group
                            id="fieldset-1"
                            class="input-curso"
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
                                class="input-leccion"
                                label="Nombre de la lección"
                                :label-for="'lesson-' + k"
                            >
                                <div class="d-flex flex-row align-items-center">
                                    <i v-b-toggle.collapse-chapters variant="primary" @click="upDownChapters" class="fas up-down mr-3" v-bind:class="{'fa-chevron-down': chaptersVisible, 'fa-chevron-up' : !chaptersVisible }"></i>
                                    <b-form-input :id="'lesson-' + k" v-model="course[0].lessons[k].name" trim></b-form-input>
                                    <i class="fas fa-plus" @click="createChapter(k)"></i>
                                    <i class="fas fa-minus"></i>
                                </div>
                            </b-form-group>
                            <b-collapse visible id="collapse-chapters">
                                <div class="crear-capitulo" v-for="(chapter, j) in course[0].lessons[k].chapters" :key="'chapter-' + j">
                                    <b-form-group
                                        :id="'chapter-' + j"
                                        class="input-capitulo"
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
                            </b-collapse>
                        </div>
                    </div>
                    <button @click="createCourse">Guardar curso</button>
                </form>
            </div>
        </div>
        <div class="contenedor-review-course">
            <h2>hola</h2>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    computed: {
        token() {
            return this.$store.state.token
        }
    },
    data() {
        return {
            chaptersVisible: true,
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
        upDownChapters() {
            this.chaptersVisible = !this.chaptersVisible
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
            Axios.defaults.headers.common['Authorization'] = `Bearer ${this.token} `
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
    display: flex;
    flex-direction: column;
    border-right: 1px solid;
    padding: 30px;
    align-items: center;
}

i.fas.fa-plus, .fa-minus {
    font-size: 1.5rem;
    margin-left: 1.2rem;
    cursor: pointer;
}

.create {
    h1 {
        display: inline-block;
        padding: 2rem;
        background-color: #97b388;
        color: white;
    }
}

.crear-capitulo {
    margin-left: 4rem;
}

.crear-pantalla {
    padding: 2rem;
    background: #dfecf7;
}
.crear-pregunta  {
    padding: 2rem;
    background: #c0c2c3;
}

.crear-respuesta {
    padding: 2rem;
    background: #c5e8a2;
}

.main-container-course {
    display: grid;
    grid-template-columns: 70% auto;
}

.create-body {
    width: 42vw;
}

.input-curso {
    background: #70c7af;
    padding: 2rem;
}

.input-leccion {
    background: #5dafaf;
    padding: 2rem;
}

.input-capitulo {
    padding: 2rem;
    background: #9bd5ff;
}

.up-down {
    transition: all 2s ease;
    cursor: pointer;
    font-size: 1.5rem;
}

</style>
