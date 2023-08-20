import { defineStore } from 'pinia'
import api from '@/utils/api'
import type { Message } from '@/types/message'
import type { CreateState } from '@/types/stores'
import type { SubmissionErrors } from '@/types/error'
import { SubmissionError } from '@/utils/error'

interface State extends CreateState<Message> {}

export const useMessageCreateStore = defineStore('messageCreate', {
  state: (): State => ({
    created: undefined,
    isLoading: false,
    error: undefined,
    violations: undefined
  }),

  actions: {
    async create(payload: Message) {
      this.setError('')
      this.toggleLoading()

      try {
        const response = await api('messages', {
          method: 'POST',
          body: JSON.stringify(payload)
        })
        const data: Message = await response.json()

        this.toggleLoading()
        this.setCreated(data)
      } catch (error) {
        this.toggleLoading()

        if (error instanceof SubmissionError) {
          this.setViolations(error.errors)
          this.setError(error.errors._error)
          return
        }

        if (error instanceof Error) {
          this.setError(error.message)
        }
      }
    },

    setCreated(created: Message) {
      this.created = created
    },

    toggleLoading() {
      this.isLoading = !this.isLoading
    },

    setError(error: string) {
      this.error = error
    },

    setViolations(violations: SubmissionErrors) {
      this.violations = violations
    }
  }
})
