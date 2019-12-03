// 空欄チェック
export function checkBlank(value) {
    if (value === '' || value === null || value === undefined) {
        return true
    }
    return false
}