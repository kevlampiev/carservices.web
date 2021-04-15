import moment from "moment";


/**
 * Конвертирует элемент расписания в тот, что подходит для базы
 * @param slot  правильный timeslot
 * @param types
 */
export function slot2WrySlot(slot, types) {
    const cdate = new Date(slot.slotDateTime)
    const typeObj = types.find(el => el.name === slot.name)
    let result = Object.assign({}, slot)
    result.work_day = moment(cdate).format('YYYY-MM-DD')
    result.work_time = cdate.getHours() + cdate.getMinutes() / 60
    result.service_type_id = typeObj.id
    delete result.slotDateTime
    return result
}

export function wrySlot2slot(wrySlot, types) {

}
