pipeline {
    agent any
    environment {
        COMPOSE_PROJECT_NAME = 'jenkinslamp'
    }
    stages {
        stage('Clean up') {
            steps {
                script {
                    sh 'docker-compose -p jenkinslamp -f docker-compose.yml down --volumes --remove-orphans || true'
                }
            }
        }
        stage('Build and Deploy') {
            steps {
                script {
                    sh 'docker-compose -p jenkinslamp -f docker-compose.yml up -d --build'
                }
            }
        }
    }
}
