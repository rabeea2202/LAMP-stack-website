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

    stage('Wait for DB') {
      steps {
        echo 'Waiting for MySQL to initialize...'
        sh 'sleep 20' 
      }
    }

    stage('Run Tests') {
      steps {
        sh 'rm -rf lamp-website-tests'
        sh 'git clone https://github.com/rabeea2202/lamp-website-tests.git'
        sh 'pip3 install selenium'
        sh 'sudo apt-get install -y chromium-chromedriver'
        sh 'python3 lamp-website-tests/selenium_test_suite.py'
      }
    }
    }
  }

  post {
    success {
      script {
        def committerEmail = sh(script: "git log -1 --pretty=format:%ae", returnStdout: true).trim()
        def gitAuthor = sh(script: "git log -1 --pretty=format:%an", returnStdout: true).trim()

        def emailMap = [
          'rabeea2202'   : 'rabeeachughtai1@gmail.com',
          'malik-qasim'  : 'qasimalik@gmail.com'
        ]

        if (committerEmail.contains("noreply.github.com")) {
          committerEmail = emailMap.get(gitAuthor, "fallback-team-email@example.com")
        }

        echo "Sending success email to: ${committerEmail}"

        emailext (
          subject: "Build Success: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
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
        def committerEmail = sh(script: "git log -1 --pretty=format:%ae", returnStdout: true).trim()
        def gitAuthor = sh(script: "git log -1 --pretty=format:%an", returnStdout: true).trim()

        def emailMap = [
          'rabeea2202'   : 'rabeeachughtai1@gmail.com',
          'malik-qasim'  : 'qasimalik@gmail.com'
        ]

        if (committerEmail.contains("noreply.github.com")) {
          committerEmail = emailMap.get(gitAuthor, "fallback-team-email@example.com")
        }

        echo "Sending failure email to: ${committerEmail}"

        emailext (
          subject: "Build Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
          body: """Hi ${gitAuthor},

Your recent push failed the tests. Please check the logs and fix the issue.

View Build: ${env.BUILD_URL}
""",
          to: "${committerEmail}"
        )
      }
    }
  }
}
