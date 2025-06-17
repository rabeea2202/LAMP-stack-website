pipeline {
  agent any

  environment {
    COMPOSE_PROJECT_NAME = 'jenkinslamp'
  }

  stages {
    stage('Build and Deploy') {
      steps {
        sh 'docker-compose -p jenkinslamp -f docker-compose.yml down --volumes --remove-orphans'
        sh 'docker-compose -p jenkinslamp -f docker-compose.yml up -d --build --force-recreate'
      }
    }


    stage('Run Tests') {
      steps {
        sh 'rm -rf lamp-website-tests'
        sh 'git clone https://github.com/rabeea2202/lamp-website-tests.git'
        sh 'chmod +x lamp-website-tests/test_main.sh'
        sh './lamp-website-tests/test_main.sh'
      }
    }
  }

  post {
    success {
      script {
        def committerEmail = sh(script: "git log -1 --pretty=format:'%ae'", returnStdout: true).trim()
        def gitAuthor = sh(script: "git log -1 --pretty=format:'%an'", returnStdout: true).trim()

        // Map GitHub usernames to real emails
        def emailMap = [
          'rabeea2202' : 'rabeeachughtai1@gmail.com',
          'malik-qasim'  : 'qasimalik@gmail.com'
        ]

        // Fallback if GitHub hides email
        if (committerEmail.contains("noreply.github.com")) {
          committerEmail = emailMap.get(gitAuthor, "fallback-team-email@example.com")
        }

        echo "Sending success email to: ${committerEmail}"

        emailext (
          subject: "Build Successful: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
          body: """Hi ${gitAuthor},

Your push passed all tests!

View Build: ${env.BUILD_URL}
""",
          to: "${committerEmail}"
        )
      }
    }

    failure {
      script {
        def committerEmail = sh(script: "git log -1 --pretty=format:'%ae'", returnStdout: true).trim()
        def gitAuthor = sh(script: "git log -1 --pretty=format:'%an'", returnStdout: true).trim()

        def emailMap = [
          'rabeea2202' : 'rabeeachughtai1@gmail.com',
          'malik-qasim'  : 'qasimalik@gmail.com'
        ]

        if (committerEmail.contains("noreply.github.com")) {
          committerEmail = emailMap.get(gitAuthor, "fallback-team-email@example.com")
        }

        echo "Sending failure email to: ${committerEmail}"

        emailext (
          subject: "Build Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
          body: """Hi ${gitAuthor},

Your recent push failed the tests.

Please review the logs and fix the issues.

View Build: ${env.BUILD_URL}
""",
          to: "${committerEmail}"
        )
      }
    }
  }
}
