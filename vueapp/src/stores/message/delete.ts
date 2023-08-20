import { defineStore } from 'pinia'
import api from '@/utils/api'
import type { Message } from '@/types/message'
import type { DeleteState } from '@/types/stores'

interface State extends DeleteState<Message> {}

export const useMessageDeleteStore = defineStore('messageDelete', {
  state: (): State => ({
    deleted: undefined,
    mercureDeleted: undefined,
    isLoading: false,
    error: undefined
  }),

  actions: {
    async deleteItem(item: Message) {
      this.setError('')
      this.toggleLoading()

      if (!item?.['@id']) {
        this.setError('No message found. Please reload')
        return
      }

      try {
        await api(item['@id'], { method: 'DELETE' })

        this.toggleLoading()
        this.setDeleted(item)
        this.setMercureDeleted(undefined)
      } catch (error) {
        this.toggleLoading()

        if (error instanceof Error) {
          this.setError(error.message)
        }
      }
    },

    toggleLoading() {
      this.isLoading = !this.isLoading
    },

    setDeleted(deleted: Message) {
      this.deleted = deleted
    },

    setMercureDeleted(mercureDeleted: Message | undefined) {
      this.mercureDeleted = mercureDeleted
    },

    setError(error: string) {
      this.error = error
    }
  }
})
