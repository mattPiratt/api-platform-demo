import { defineStore } from 'pinia'
import api from '@/utils/api'
import { extractHubURL } from '@/utils/mercure'
import type { Message } from '@/types/message'
import type { UpdateState } from '@/types/stores'
import type { SubmissionErrors } from '@/types/error'
import { SubmissionError } from '@/utils/error'

interface State extends UpdateState<Message> {}

export const useMessageUpdateStore = defineStore('messageUpdate', {
  state: (): State => ({
    updated: undefined,
    retrieved: undefined,
    isLoading: false,
    error: undefined,
    hubUrl: undefined,
    violations: undefined
  }),

  actions: {
    async retrieve(id: string) {
      this.setError('')
      this.toggleLoading()

      try {
        const response = await api(id)
        const data: Message = await response.json()
        const hubUrl = extractHubURL(response)

        this.toggleLoading()
        this.setRetrieved(data)

        if (hubUrl) {
          this.setHubUrl(hubUrl)
        }
      } catch (error) {
        this.toggleLoading()

        if (error instanceof Error) {
          this.setError(error.message)
        }
      }
    },

    async update(payload: Message) {
      this.setError('')
      this.toggleLoading()

      if (!this.retrieved?.['@id']) {
        this.setError('No message found. Please reload')
        return
      }

      try {
        const response = await api(this.retrieved['@id'], {
          method: 'PUT',
          headers: new Headers({ 'Content-Type': 'application/ld+json' }),
          body: JSON.stringify(payload)
        })
        const data: Message = await response.json()

        this.toggleLoading()
        this.setUpdated(data)
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

    setRetrieved(retrieved: Message) {
      this.retrieved = retrieved
    },

    setUpdated(updated: Message) {
      this.updated = updated
    },

    setHubUrl(hubUrl: URL) {
      this.hubUrl = hubUrl
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
